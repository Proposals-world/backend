<?php
// app/Services/InfobipService.php - FIXED VERSION

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
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
    public function sendWhatsAppTemplate(string $to, string $templateName, string $language = "en_GB", array $parameters = []): array
    {
        // Strip any leading "+"
        $to = ltrim($to, '+');

        // Important: Ensure parameters is an array, even if it's empty
        if (!is_array($parameters)) {
            $parameters = [];
        }

        // Create the payload according to Infobip API specifications
        $payload = [
            'messages' => [
                [
                    'from' => $this->from,
                    'to' => $to,
                    'type'=>"text",
                    'content' => [
                        'templateName' => $templateName,
                        'language' => $language,
                        'templateData' => [
                            'body' => [
                                'placeholders' => array_values($parameters) // Ensure it's a flat array
                            ]
                        ]
                    ]
                ]
            ]
        ];

        // Log the payload for debugging
        Log::debug('Infobip WhatsApp Template Payload', ['payload' => $payload]);

        try {
            $resp = $this->client->post('/whatsapp/1/message/template', [
                'json' => $payload
            ]);

            return json_decode($resp->getBody()->getContents(), true);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $errorResponse = json_decode($e->getResponse()->getBody(), true);
                Log::error('Infobip Template Error', ['error' => $errorResponse]);
                return ['error' => true, 'details' => $errorResponse];
            }
            Log::error('Infobip Connection Error', ['error' => $e->getMessage()]);
            return ['error' => true, 'details' => $e->getMessage()];
        }
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