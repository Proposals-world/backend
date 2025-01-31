<?php

namespace App\Services;

use Google\Auth\ApplicationDefaultCredentials;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class FCMService
{
    protected static function getAccessToken()
    {
        $credentialsPath = config('firebase.credentials');

        // dd($credentialsPath);
        putenv("GOOGLE_APPLICATION_CREDENTIALS={$credentialsPath}");

        $client = ApplicationDefaultCredentials::getCredentials(['https://www.googleapis.com/auth/firebase.messaging']);
        $authToken = $client->fetchAuthToken();
// dd($authToken);
        return $authToken['access_token'] ?? null;
    }

    public static function sendNotification($title, $body, $token)
    {
        $accessToken = self::getAccessToken();
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