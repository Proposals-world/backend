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

    public function __construct()
    {
        $this->baseUrl     = rtrim(config('services.payment_gateway.base_url'), '/');
        $this->merchantId  = config('services.payment_gateway.merchant_id');
        $this->apiUsername = config('services.payment_gateway.api_username');
        $this->apiPassword = config('services.payment_gateway.api_password');
    }

    /* -----------------------------------------------------------------
     | HOSTED CHECKOUT  (recommended – mirrors “INITIATE CHECKOUT” in the
     | Postman collection)                                                  |
     * ----------------------------------------------------------------- */

    public function createCheckoutSession(
        string  $orderId,
        float   $amount,
        string  $currency      = 'USD',
        ?string $returnUrl     = null,
        string  $operation     = 'PURCHASE',   // PURCHASE | AUTHORIZE | VERIFY
        string  $description   = 'Subscription Package Purchase'
    ): array {
        $url  = "{$this->baseUrl}/api/rest/version/100/merchant/{$this->merchantId}/session";

        $payload = [
            'apiOperation' => 'INITIATE_CHECKOUT',
            'checkoutMode' => 'WEBSITE',
            'interaction'  => [
                'operation' => strtoupper($operation),
                'merchant'  => [
                    'name' => config('app.name'),
                    'url'  => config('app.url'),
                ],
                'returnUrl' => $returnUrl ?? config('app.url'),
            ],
            'order'       => [
                'amount'      => number_format($amount, 2, '.', ''),
                'currency'    => $currency,
                'id'          => (string) $orderId,
                'description' => $description,
            ],
        ];

        return $this->request('POST', $url, $payload);
    }

    /** Build the full-page redirect URL that sends the customer to the hosted page. */
    public function getCheckoutUrl(string $sessionId): string
    {
        // Same pattern used in the docs & Postman collection
        return "{$this->baseUrl}/checkout/version/100/merchant/{$this->merchantId}/session/{$sessionId}";
    }

    /* -----------------------------------------------------------------
     |  MISC OPERATIONS                                                   |
     * ----------------------------------------------------------------- */

    public function retrieveOrder(string $orderId): array
    {
        $url = "{$this->baseUrl}/api/rest/version/100/merchant/{$this->merchantId}/order/{$orderId}";
        return $this->request('GET', $url);
    }

    /* -----------------------------------------------------------------
     |  LOW-LEVEL HELPER                                                  |
     * ----------------------------------------------------------------- */

    private function request(string $method, string $url, array $body = []): array
    {
        $http = Http::withBasicAuth("merchant.{$this->apiUsername}", $this->apiPassword)
                    ->acceptJson()
                    ->contentType('application/json');

        $response = $method === 'GET'
            ? $http->get($url)
            : $http->{$method}($url, $body);

        Log::channel('payment')->info('Gateway call', [
            'method'   => $method,
            'url'      => $url,
            'payload'  => $body,
            'status'   => $response->status(),
            'response' => $response->json(),
        ]);

        // we always return a unified structure – caller decides what to do
        return [
            'success' => $response->successful(),
            'status'  => $response->status(),
            'data'    => $response->json(),
            'raw'     => $response->body(),
        ];
    }
}