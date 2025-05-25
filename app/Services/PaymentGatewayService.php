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
        $this->baseUrl     = rtrim(config('services.payment_gateway.base_url'), '/');
        $this->merchantId  = config('services.payment_gateway.merchant_id');
        $this->apiUsername = config('services.payment_gateway.api_username');
        $this->apiPassword = config('services.payment_gateway.api_password');
    }

    /* -----------------------------------------------------------------
     | HOSTED CHECKOUT (apiOperation INITIATE_CHECKOUT)                  |
     * ----------------------------------------------------------------- */

    public function createCheckoutSession(
        string  $orderId,
        float   $amount,
        string  $currency    = 'USD',
        string  $returnUrl,
        string  $operation   = 'PURCHASE',   // PURCHASE | AUTHORIZE | VERIFY
        string  $description = 'Subscription package purchase'
    ): array {
        $url      = "{$this->baseUrl}/api/rest/version/".self::API_VERSION."/merchant/{$this->merchantId}/session";
        $payload  = [
            'apiOperation' => 'INITIATE_CHECKOUT',
            'checkoutMode' => 'WEBSITE',
            'interaction'  => [
                'operation' => strtoupper($operation),
                'merchant'  => [
                    'name' => config('app.name'),
                    'url'  => config('app.url'),
                ],
                'returnUrl' => $returnUrl,
            ],
            'order'       => [
                'amount'      => number_format($amount, 2, '.', ''),
                'currency'    => $currency,
                'id'          => $orderId,
                'description' => $description,
            ],
        ];

        return $this->request('POST', $url, $payload); // POST is correct per MPGS collection  [oai_citation:0‡GatewayAPIPostmanCollection.json](file-service://file-B1SVnox1qheBUVZxtsgtSE)
    }

    /** Hosted checkout **page** URL that is loaded inside the iframe. */
    public function getCheckoutUrl(string $sessionId): string
    {
        return "{$this->baseUrl}/checkout/version/".self::API_VERSION."/merchant/{$this->merchantId}/session/{$sessionId}";
    }

    /* -----------------------------------------------------------------
     | Helpers                                                           |
     * ----------------------------------------------------------------- */

    public function retrieveOrder(string $orderId): array
    {
        $url = "{$this->baseUrl}/api/rest/version/".self::API_VERSION."/merchant/{$this->merchantId}/order/{$orderId}";
        return $this->request('GET', $url);
    }

    private function request(string $method, string $url, array $body = []): array
    {
        $http = Http::withBasicAuth("merchant.{$this->apiUsername}", $this->apiPassword)
                    ->acceptJson()
                    ->contentType('application/json');

        $response = $method === 'GET' ? $http->get($url) : $http->{$method}($url, $body);

        Log::channel('payment')->info('MPGS call', [
            'method'   => $method,
            'url'      => $url,
            'payload'  => $body,
            'status'   => $response->status(),
            'response' => $response->json(),
        ]);

        return [
            'success' => $response->successful(),
            'status'  => $response->status(),
            'data'    => $response->json(),
            'raw'     => $response->body(),
        ];
    }
}