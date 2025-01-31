<?php

namespace App\Traits;

use Google\Auth\ApplicationDefaultCredentials;
use Illuminate\Support\Facades\Http;

trait FCMTrait
{
    protected function getAccessToken()
    {
        $credentialsPath = config('firebase.credentials');
        putenv("GOOGLE_APPLICATION_CREDENTIALS={$credentialsPath}");

        $client = ApplicationDefaultCredentials::getCredentials(['https://www.googleapis.com/auth/firebase.messaging']);
        $authToken = $client->fetchAuthToken();

        return $authToken['access_token'] ?? null;
    }

    public function sendFCMNotification($title, $body, $token)
    {
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return ['error' => 'Unable to get Firebase Access Token'];
        }

        $projectId = config('firebase.project_id');
        $fcmUrl = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

        $data = [
            'message' => [
                'token' => $token,
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                ],
                'data' => [
                    'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                ],
            ],
        ];

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$accessToken}",
            'Content-Type' => 'application/json',
        ])->post($fcmUrl, $data);

        return $response->json();
    }
}