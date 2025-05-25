<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentWebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Verify webhook signature
        $signature = $request->header('X-Gateway-Signature');
        $payload = $request->getContent();
        
        if (!$this->verifySignature($payload, $signature)) {
            Log::warning('Invalid webhook signature');
            return response('Invalid signature', 403);
        }

        $data = $request->all();
        
        if (isset($data['order']['id'])) {
            $orderId = $data['order']['id'];
            $payment = Payment::where('order_id', $orderId)->first();
            
            if ($payment) {
                $this->updatePaymentStatus($payment, $data);
            }
        }

        return response('OK', 200);
    }

    private function verifySignature($payload, $signature)
    {
        $secret = config('services.payment_gateway.webhook_secret');
        $expectedSignature = hash_hmac('sha256', $payload, $secret);
        return hash_equals($expectedSignature, $signature);
    }

    private function updatePaymentStatus($payment, $data)
    {
        if ($data['result'] === 'SUCCESS') {
            $payment->update([
                'status' => 'completed',
                'gateway_response_code' => $data['response']['gatewayCode'],
                'gateway_response' => $data,
                'paid_at' => now()
            ]);

            // Add contacts to user
            $this->addContactsToUser($payment);
        } else {
            $payment->update([
                'status' => 'failed',
                'gateway_response' => $data
            ]);
        }
    }

    private function addContactsToUser($payment)
    {
        Subscription::updateOrCreate(
            ['user_id' => $payment->user_id],
            [
                'package_id' => $payment->package_id,
                'contacts_remaining' => $payment->package->contact_limit,
                'status' => 'active'
            ]
        );
    }
}