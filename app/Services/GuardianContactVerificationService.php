<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GuardianContactVerificationService
{
    protected string $baseUrl;
    protected string $apiKey;
    protected string $sender;

    public function __construct()
    {
        $this->baseUrl = config('services.infobip.base_url');
        $this->apiKey  = config('services.infobip.api_key');
        $this->sender  = config('services.infobip.sender');
    }

    public function sendVerificationCode(string $phone, string $code): array
    {
        return Http::withHeaders([
            'Authorization' => "App {$this->apiKey}",
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json',
        ])->post("{$this->baseUrl}/sms/2/text/advanced", [
            'messages' => [[
                'from'         => $this->sender,
                'destinations' => [['to' => $phone]],
                'text'         => "Your guardian verification code is: {$code}",
            ]]
        ])->json();
    }
}
