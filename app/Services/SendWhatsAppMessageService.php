<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SendWhatsAppMessageService
{
    protected string $apiUrl;
    protected string $sessionId;

    public function __construct(WhatsAppContactService $contactService)
    {
        // Local API
        $dbSessionId = $contactService->getSessionId();
        $this->sessionId = $dbSessionId ?? config('services.whatsapp.session', 'samer');
        $this->apiUrl    = env('API_URL') . '/' . $this->sessionId . '/messages/send'; //config('services.whatsapp.url');
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
        // dd("from send " . $this->sessionId);

        $payload = [
            "sessionId" => $this->sessionId,
            "jid"       => $to . "@s.whatsapp.net",
            "type"      => "number",
            "message"   => ["text" => $text],
            "options"   => new \stdClass(), // empty object
        ];

        // dd($payload); // Debugging line, remove in production
        $response = Http::post($this->apiUrl, $payload);
        // dd($response->body());
        return $response->successful() ? $response->json() : [
            'error' => true,
            'status' => $response->status(),
            'body'   => $response->body()
        ];
    }
}
