<?php
// app/Services/InfobipService.php - FIXED VERSION

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Number;

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

    // this function used to send a WhatsApp message with phone number to the parent to ensure the number given is correct
    public function sendWhatsAppMessage(string $toParentNumber, string $childPhoneNumber, string $language, $otp): array
    {
        // Format phone number (remove + and leading 0)
        // $to = ltrim($to, '+');
        // $to = ltrim($to, '0');
        // if (!str_starts_with($to, '962')) {
        //     $to = '962' . $to; // Add Jordan country code if missing
        // }
        if ($language === 'ar') {
            $message = "أهلا بكم، ها قد تم تسجيل ابنتكم صاحبة رقم الهاتف ($childPhoneNumber) بأول تطبيق اردني للزواج المتوافق مع عاداتنا وتقاليدنا. ويعمل هذا التطبيق بطريقة عصرية تحاكي احتياج المجتمع وتحترم قيمه. يرجى ارسال رمز التحقق التالي من خلال التطبيق. حيث ستتم مشاركة رقم هاتفكم للتواصل بهدف زيارة العروس والتعرف على العائلة. يرجى ارسال رمز التحقق التالي من خلال التطبيق: دامت الأفراح عامرة في بيوتكم. $otp";
        } else {
            $message = "Welcome! Your daughter, whose phone number is ($childPhoneNumber), has been registered in the first Jordanian marriage application that aligns with our customs and traditions. This application works in a modern way that meets the needs of society and respects its values. Please send the following verification code through the application. Your phone number will be shared for communication purposes to arrange a visit to the bride and get to know the family. Please send the following verification code through the application: May joy always fill your homes. $otp";
        }
        $payload = [
            'messages' => [
                [
                    'from' => '447860088970', // Static sender number
                    'to' => $toParentNumber,
                    'content' => [
                        'templateName' => 'abandoned_checkout', // Static template name
                        'templateData' => [
                            'body' => [
                                'placeholders' => [$message] // Using message as the placeholder
                            ]
                        ],
                        'language' => $language
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
    // this function used to send otp to the phone number that the user entered in the registration proccess
    public function sendWhatsAppMessagePhoneNumber($usernumber, string $language, $otp): array
    {
        // Format phone number (remove + and leading 0)
        // $to = ltrim($to, '+');
        // $to = ltrim($to, '0');
        // if (!str_starts_with($to, '962')) {
        //     $to = '962' . $to; // Add Jordan country code if missing
        // }
        // if ($language === 'ar') {
        //     $message = "أهلا بكم، ها قد تم تسجيل ابنتكم صاحبة رقم الهاتف ($childPhoneNumber) بأول تطبيق اردني للزواج المتوافق مع عاداتنا وتقاليدنا. ويعمل هذا التطبيق بطريقة عصرية تحاكي احتياج المجتمع وتحترم قيمه. يرجى ارسال رمز التحقق التالي من خلال التطبيق. حيث ستتم مشاركة رقم هاتفكم للتواصل بهدف زيارة العروس والتعرف على العائلة. يرجى ارسال رمز التحقق التالي من خلال التطبيق: دامت الأفراح عامرة في بيوتكم. $otp";
        // } else {
        //     $message = "Welcome! Your daughter, whose phone number is ($childPhoneNumber), has been registered in the first Jordanian marriage application that aligns with our customs and traditions. This application works in a modern way that meets the needs of society and respects its values. Please send the following verification code through the application. Your phone number will be shared for communication purposes to arrange a visit to the bride and get to know the family. Please send the following verification code through the application: May joy always fill your homes. $otp";
        // }

        if ($language === 'ar') {
            $message = "رمز التحقق الخاص بك هو: $otp. يرجى إدخال هذا الرمز في التطبيق للتحقق من رقم هاتفك.";
        } else {
            $message = "Your verification code is: $otp. Please enter this code in the application to verify your phone number.";
        }
        $payload = [
            'messages' => [
                [
                    'from' => '447860088970', // Static sender number
                    'to' => $usernumber,
                    'content' => [
                        'templateName' => 'abandoned_checkout', // Static template name
                        'templateData' => [
                            'body' => [
                                'placeholders' => [$message] // Using message as the placeholder
                            ]
                        ],
                        'language' => $language
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
