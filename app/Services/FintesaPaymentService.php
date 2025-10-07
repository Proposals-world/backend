<?php

namespace App\Services;

use App\Models\SubscriptionPackage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Throwable;

class FintesaPaymentService
{
    public function createProduct(SubscriptionPackage $package): array
    {
        $baseUrl = rtrim(Config::get('services.fintesa.base_url'), '/');
        $secretKey = Config::get('services.fintesa.secret_key');
        $successUrl = Config::get('services.fintesa.success_url');

        $resolvedGender = $package->gender ?? $this->inferGenderFromFields($package);
        // All packages now use one-time payment type regardless of gender
        $priceType = 'one_time';

        $priceObject = [
            'name' => $package->package_name_en . ' One-time',
            // Fintesa dashboard currently interprets 'amount' as major currency units
            'amount' => (int) round(((float) $package->price)),
            'currency_code' => 'usd',
            'price_type' => $priceType,
            'merchant_metadata' => [
                'package_id' => (string) $package->id,
                'gender' => $resolvedGender,
            ],
        ];

        // Set maximum quantity allowed for one-time payments to avoid "out of stock" issues
        $priceObject['quantity'] = 99;

        $payload = [
            'name' => $package->package_name_en,
            'description' => 'Package' . $package->package_name_en . ' for ' . $resolvedGender,
            'success_url' => $successUrl,
            'prices' => [ $priceObject ],
        ];

        try {
            // Build endpoint; dev env requires '/development-menacart-server'
            $prefix = str_contains($baseUrl, 'development-menacart-server') ? '' : '/development-menacart-server';
            $endpoint = $baseUrl . $prefix . '/api/v2/product/create_product_kyc/' . $secretKey;
            Log::info('Fintesa createProduct request', ['endpoint' => $endpoint, 'payload' => $payload]);

            $response = Http::timeout(20)->retry(2, 500)->post($endpoint, $payload);

            if (!$response->successful()) {
                Log::error('Fintesa createProduct failed', ['status' => $response->status(), 'body' => $response->body()]);
                return [
                    'ok' => false,
                    'error' => 'Failed to create product',
                    'status' => $response->status(),
                    'response' => $response->json(),
                ];
            }

            $data = $response->json();
            Log::info('Fintesa createProduct response', ['response' => $data]);

            // Observed response shape: prices[0].payment_link
            $paymentUrl = data_get($data, 'prices.0.payment_link');

            // Attempt to parse product_id and price_id from payment_link
            $productId = null;
            $priceId = null;
            if (is_string($paymentUrl)) {
                if (preg_match('#/(prod_[A-Za-z0-9]+)/#', $paymentUrl, $m)) {
                    $productId = $m[1] ?? null;
                }
                if (preg_match('#/(price_[A-Za-z0-9]+)$#', $paymentUrl, $m2)) {
                    $priceId = $m2[1] ?? null;
                }
                if (!$priceId && preg_match('#/(prod_[A-Za-z0-9]+)/(?:(price_[A-Za-z0-9]+))#', $paymentUrl, $m3)) {
                    $productId = $productId ?: ($m3[1] ?? null);
                    $priceId = $m3[2] ?? null;
                }
            }
            return [
                'ok' => true,
                'data' => $data,
                'product_id' => $productId,
                'price_id' => $priceId,
                'payment_url' => $paymentUrl,
            ];
        } catch (Throwable $e) {
            Log::error('Fintesa createProduct exception', ['message' => $e->getMessage()]);
            return ['ok' => false, 'error' => $e->getMessage()];
        }
    }

    public function getPaymentUrl(SubscriptionPackage $package): array
    {
        $baseUrl = Config::get('services.fintesa.base_url');
        $successUrl = Config::get('services.fintesa.success_url');

        // Prefer stored payment_url if we received it from product creation
        if (!empty($package->payment_url)) {
            return ['ok' => true, 'payment_url' => $package->payment_url];
        }

        // Fallback: construct deterministic URL using product id
        if (!$package->fintesa_product_id) {
            return ['ok' => false, 'error' => 'Package not synced with Fintesa'];
        }

        $paymentUrl = rtrim($baseUrl, '/') . '/checkout/' . $package->fintesa_product_id . '?success_url=' . urlencode($successUrl) . '&metadata[package_id]=' . $package->id;

        return [
            'ok' => true,
            'payment_url' => $paymentUrl,
        ];
    }

    public function handleWebhook(array $payload): array
    {
        // Stub that simply returns parsed essentials; controller will complete the business logic
        $eventType = $payload['event'] ?? $payload['type'] ?? 'unknown';
        $status = data_get($payload, 'data.status');
        $productId = data_get($payload, 'data.product_id');
        $priceId = data_get($payload, 'data.price_id');
        $amount = data_get($payload, 'data.amount');
        $currency = data_get($payload, 'data.currency', 'USD');
        $userId = data_get($payload, 'data.metadata.user_id');
        $packageId = (int) data_get($payload, 'data.metadata.package_id');

        return compact('eventType', 'status', 'productId', 'priceId', 'amount', 'currency', 'userId', 'packageId');
    }

    private function inferGenderFromFields(SubscriptionPackage $package): string
    {
        if (!is_null($package->contact_limit) && (int) $package->contact_limit > 0) {
            return 'male';
        }
        return 'female';
    }

    /**
     * Check if a product's purchase count is high and recreate it if necessary
     *
     * @param SubscriptionPackage $package
     * @param int $threshold The threshold at which to recreate the product
     * @return array 
     */
    public function checkAndRecreateProduct(SubscriptionPackage $package, int $threshold = 90): array
    {
        // If purchase count is below threshold, no need to recreate
        if ($package->purchase_count < $threshold) {
            return [
                'ok' => true,
                'message' => 'No recreation needed',
                'recreated' => false
            ];
        }

        // Create new product with fresh quantity
        $createResult = $this->createProduct($package);
        
        if ($createResult['ok'] ?? false) {
            // Update the package with new product information
            $package->fintesa_product_id = $createResult['product_id'] ?? null;
            $package->fintesa_price_id = $createResult['price_id'] ?? null;
            if (!empty($createResult['payment_url'])) {
                $package->payment_url = $createResult['payment_url'];
            }
            // Reset purchase count
            $package->purchase_count = 0;
            $package->save();
            
            return [
                'ok' => true,
                'message' => 'Product recreated with fresh quantity',
                'recreated' => true,
                'product_id' => $package->fintesa_product_id,
                'payment_url' => $package->payment_url,
            ];
        }
        
        return [
            'ok' => false,
            'error' => 'Failed to recreate product',
            'recreated' => false
        ];
    }
}

