<?php
// app/Services/InfobipService.php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class InfobipService
{
    protected Client $client;
    protected string $from;
    protected string $contentType = 'text';

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

        // static “from” number (no “+”)
        $this->from = env('INFOBIP_SENDER');
    }

    /**
     * Send a plain‐text WhatsApp message.
     *
     * @param  string  $to      Recipient in E.164 (may include “+”)
     * @param  string  $message Your message text
     * @return array
     */
    public function sendWhatsAppMessage(string $to, string $message): array
    {
        // strip any leading “+”
        $to = ltrim($to, '+');

        $payload = [
            'from'    => $this->from,
            'to'      => $to,
            'content' => [
                'type' => $this->contentType,
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
