<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SendWhatsAppMessageService
{
    protected string $apiUrl;
    protected string $sessionId;

    public function __construct()
    {
        // Local API
        $this->apiUrl    =  'http://localhost:3000/samer/messages/send'; //config('services.whatsapp.url');
        $this->sessionId = config('services.whatsapp.session', 'samer'); // try to manipulate this value from env file
    }

    /**
     * Send WhatsApp Message via local API
     *
     * @param string $to Receiver phone number (without @s.whatsapp.net)
     * @param string $text Message text
     * @return array Response
     */
    public function send(string $to, string $text): array
    {
        // Validate phone number format
        $to = ltrim($to, '+');

        $payload = [
            "sessionId" => $this->sessionId,
            "jid"       => $to . "@s.whatsapp.net",
            "type"      => "number",
            "message"   => ["text" => $text],
            "options"   => new \stdClass(), // empty object
        ];
        // dd($payload); // Debugging line, remove in production
        $response = Http::post($this->apiUrl, $payload);

        return $response->successful() ? $response->json() : [
            'error' => true,
            'status' => $response->status(),
            'body'   => $response->body()
        ];
    }
}
