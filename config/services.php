<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],
    'payment_gateway' => [
        'base_url'     => env('PAYMENT_GATEWAY_BASE_URL'),   // https://example.gateway.mastercard.com
        'merchant_id'  => env('PAYMENT_GATEWAY_MERCHANT_ID'),// e.g. TESTMERCHANT123
        'api_username' => env('PAYMENT_GATEWAY_API_USERNAME'),// value *without* “merchant.” prefix
        'api_password' => env('PAYMENT_GATEWAY_API_PASSWORD'),
        'callback_url' => env('PAYMENT_GATEWAY_CALLBACK_URL'),
    ],
    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'infobip' => [
        'base_url' => env('INFOBIP_BASE_URL'),
        'api_key' => env('INFOBIP_API_KEY'),
        'sender' => env('INFOBIP_SENDER'),
    ],


];
