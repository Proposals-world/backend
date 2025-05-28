<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentGatewayService
{
    private string $baseUrl;
    private string $merchantId;
    private string $apiUsername;
    private string $apiPassword;
    private const API_VERSION = 100;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.payment_gateway.base_url'), '/');
        $this->merchantId = config('services.payment_gateway.merchant_id');
        $this->apiUsername = config('services.payment_gateway.api_username');
        $this->apiPassword = config('services.payment_gateway.api_password');
    }

    /* -----------------------------------------------------------------
     | HOSTED CHECKOUT (apiOperation INITIATE_CHECKOUT)                  |
     * ----------------------------------------------------------------- */

    public function createCheckoutSession(
        string $orderId,
        float $amount,
        string $currency = 'USD',
        string $returnUrl,
        string $description = 'Subscription package purchase'
    ): array {
        $url = "{$this->baseUrl}/api/rest/version/" . self::API_VERSION . "/merchant/{$this->merchantId}/session";
        $payload = [
            'apiOperation' => 'INITIATE_CHECKOUT',
            'interaction' => [
                'operation' => 'PURCHASE',
                'returnUrl' => $returnUrl,
                'cancelUrl' => route('user.payment.failed', ['payment' => $orderId]),
                'merchant' => [
                    'name' => config('app.name'),
                    'url' => config('app.url'),
                    'logo' => secure_asset('frontend/img/logo/proposals-logo-removebg-preview.png'),
                ],
            ],
            'order' => [
                'id' => $orderId,
                'amount' => number_format($amount, 2, '.', ''),
                'currency' => $currency,
                'description' => $description,
            ],
        ];

        return $this->request('POST', $url, $payload);
    }

    /** Hosted checkout **page** URL that is loaded inside the iframe. */
    public function getCheckoutUrl(string $sessionId): string
    {
        return "{$this->baseUrl}/checkout/pay/{$sessionId}";
    }

    /* -----------------------------------------------------------------
     | Helpers                                                           |
     * ----------------------------------------------------------------- */

    public function retrieveOrder(string $orderId): array
    {
        $url = "{$this->baseUrl}/api/rest/version/" . self::API_VERSION . "/merchant/{$this->merchantId}/order/{$orderId}";
        return $this->request('GET', $url);
    }

    private function request(string $method, string $url, array $body = []): array
    {
        $http = Http::withBasicAuth("merchant.{$this->merchantId}", $this->apiPassword)
            ->acceptJson()
            ->contentType('application/json');

        $response = $method === 'GET' ? $http->get($url) : $http->{$method}($url, $body);

        Log::channel('payment')->info('MPGS call', [
            'method' => $method,
            'url' => $url,
            'payload' => $body,
            'status' => $response->status(),
            'response' => $response->json(),
        ]);

        return [
            'success' => $response->successful(),
            'status' => $response->status(),
            'data' => $response->json(),
            'raw' => $response->body(),
        ];
    }

    public function getMerchantId(): string
    {
        return $this->merchantId;
    }
}