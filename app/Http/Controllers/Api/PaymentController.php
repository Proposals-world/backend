<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPackage;
use App\Services\FintesaPaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function success(Request $request)
    {
        // Simple success landing; real confirmation comes via webhook
        return response()->json(['message' => 'Payment successful']);
    }

    public function paymentUrl(SubscriptionPackage $subscriptionPackage, FintesaPaymentService $paymentService)
    {
        $result = $paymentService->getPaymentUrl($subscriptionPackage);
        if (!$result['ok']) {
            return response()->json(['message' => $result['error'] ?? 'Unable to generate URL'], 422);
        }
        return response()->json(['payment_url' => $result['payment_url']]);
    }
}

