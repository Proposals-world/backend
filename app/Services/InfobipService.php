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
        // Format phone number (remove + and leading 0)
        $to = ltrim($to, '+');
        $to = ltrim($to, '0');
        if (!str_starts_with($to, '962')) {
            $to = '962' . $to; // Add Jordan country code if missing
        }

        $payload = [
            'messages' => [
                [
                    'from' => '447860088970', // Static sender number
                    'to' => $to,
                    'content' => [
                        'templateName' => 'abandoned_checkout', // Static template name
                        'templateData' => [
                            'body' => [
                                'placeholders' => [$message] // Using message as the placeholder
                            ]
                        ],
                        'language' => 'en'
                    ]
                ]
            ]
        ];

        try {
            $response = $this->client->post(env('INFOBIP_BASE_URL') . '/whatsapp/1/message/template', [ // Changed endpoint
                'json' => $payload,
                'timeout' => 30
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return [
                    'error' => true,
                    'details' => json_decode($e->getResponse()->getBody(), true)
                ];
            }
            return [
                'error' => true,
                'details' => $e->getMessage(),
                'payload' => $payload // Include payload for debugging
            ];
        }
    }
}
