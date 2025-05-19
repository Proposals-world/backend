<?php
// app/Services/InfobipService.php - FIXED VERSION

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Http;
use Illuminate\Support\Facades\Log;

class InfobipService
{
    protected Client $client;
    protected string $from;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('INFOBIP_BASE_URL'),
            'headers'  => [
                'Authorization' => 'App ' . env('INFOBIP_API_KEY'),
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ],
        ]);

        // The WhatsApp sender number
        $this->from = env('INFOBIP_SENDER');
    }

    /**
     * Send a WhatsApp template message.
     *
     * @param  string  $to           Recipient in E.164 (may include "+")
     * @param  string  $templateName The approved template name
     * @param  string  $language     Template language code (default: en)
     * @param  array   $parameters   Template parameters (if any)
     * @return array
     */
    public function sendWhatsAppTemplate($to, $templateName, $language = 'en_GB', $parameters = [])
    {
        // expects: ['123456'] if just body, or ['123456', 'urlParam'] if has button
    
        $bodyPlaceholder = $parameters[0] ?? '';
        $buttonParameter = $parameters[1] ?? null;
    
        $templateData = [
            'body' => [
                'placeholders' => [$bodyPlaceholder]
            ]
        ];
    
        if ($buttonParameter) {
            $templateData['buttons'] = [
                [
                    'type' => 'URL',
                    'parameter' => $buttonParameter
                ]
            ];
        }
    
        $payload = [
            'messages' => [
                [
                    'from' => $this->from,
                    'to' => $to,
                    'content' => [
                        'templateName' => $templateName,
                        'templateData' => $templateData,
                        'language' => $language
                    ]
                ]
            ]
        ];
    
        Log::debug('Infobip payload', ['payload' => $payload]);
    
        $response = Http::withHeaders([
            'Authorization' => 'App ' . env('INFOBIP_API_KEY'),
            'Content-Type' => 'application/json'
        ])->post(env('INFOBIP_BASE_URL') . '/whatsapp/1/message/template', $payload);
    
        return $response->json();
    }
    /**
     * Send a plain-text WhatsApp message.
     * NOTE: This can only be used within the 24-hour customer service window.
     *
     * @param  string  $to      Recipient in E.164 (may include "+")
     * @param  string  $message Your message text
     * @return array
     */
    public function sendWhatsAppMessage(string $to, string $message): array
    {
        // Strip any leading "+"
        $to = ltrim($to, '+');

        $payload = [
            'from' => $this->from,
            'to' => $to,
            'messageId'=>'a28dd97c-1ffb-4fcf-99f1-0b557ed381da',
            'content' => [
                'type' => 'text',
                'text' => $message,
            ],
        ];

        try {
            $resp = $this->client->post('/whatsapp/1/message/text', [
                'json' => $payload
            ]);

            return json_decode($resp->getBody()->getContents(), true);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return ['error' => true, 'details' => json_decode($e->getResponse()->getBody(), true)];
            }
            return ['error' => true, 'details' => $e->getMessage()];
        }
    }
}