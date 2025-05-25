<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\SubscriptionPackage;
use App\Services\PaymentGatewayService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    private $paymentGateway;

    public function __construct(PaymentGatewayService $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    public function initiatePayment(Request $request, PaymentGatewayService $gateway)
    {
        $request->validate(['package_id' => 'required|exists:subscription_packages,id']);
        $package = SubscriptionPackage::findOrFail($request->package_id);
    
        $payment = Payment::create([
            'user_id'    => $request->user()->id,
            'package_id' => $package->id,
            'amount'     => $package->price,
            'currency'   => 'USD',
            'status'     => 'pending',
        ]);
    
        $pg = $gateway->initiateBrowserPayment($package->price, 'USD', config('services.payment_gateway.callback'));
    
        $payment->update([
            'order_id'       => $pg['order_id'],
            'transaction_id' => $pg['transaction_id'],
            'gateway_response' => $pg['raw'],
        ]);
    
        return response()->json([
            'redirect_url' => $pg['redirect_url'],
            'order_id'     => $pg['order_id'],
            'transaction_id' => $pg['transaction_id'],
            'payment_id'   => $payment->id,
        ]);
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|exists:payments,id',
            'card_number' => 'required|string',
            'expiry_month' => 'required|string|size:2',
            'expiry_year' => 'required|string|size:4',
            'security_code' => 'required|string|min:3|max:4'
        ]);

        $payment = Payment::where('id', $request->payment_id)
            ->where('user_id', $request->user()->id)
            ->where('status', 'pending')
            ->firstOrFail();

        $cardData = [
            'number' => str_replace(' ', '', $request->card_number),
            'expiryMonth' => $request->expiry_month,
            'expiryYear' => $request->expiry_year,
            'securityCode' => $request->security_code
        ];

        $response = $this->paymentGateway->createPayment(
            $payment->order_id,
            $payment->transaction_id,
            $payment->amount,
            $payment->currency,
            $cardData
        );

        if ($response['success'] && 
            isset($response['data']['result']) && 
            $response['data']['result'] === 'SUCCESS') {
            
            $payment->update([
                'status' => 'completed',
                'gateway_response_code' => $response['data']['response']['gatewayCode'] ?? null,
                'gateway_response' => $response['data'],
                'paid_at' => now()
            ]);

            // Add contacts to user
            $this->addContactsToUser($payment);

            return response()->json([
                'success' => true,
                'message' => 'Payment completed successfully',
                'payment_status' => 'completed'
            ]);
        }

        $payment->update([
            'status' => 'failed',
            'gateway_response' => $response
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Payment failed',
            'error' => $response['error'] ?? 'Unknown error'
        ], 400);
    }

    public function getPaymentStatus($paymentId)
    {
        $payment = Payment::where('id', $paymentId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'payment' => [
                'id' => $payment->id,
                'status' => $payment->status,
                'amount' => $payment->amount,
                'package_name' => $payment->package->package_name_en,
                'paid_at' => $payment->paid_at
            ]
        ]);
    }

    public function getTestCards()
    {
        return [
            'success_cards' => [
                [
                    'name' => 'Visa Success',
                    'number' => '4005550000000001',
                    'expiry' => '05/25',
                    'cvv' => '123'
                ],
                [
                    'name' => 'Mastercard Success',
                    'number' => '5123456789012346',
                    'expiry' => '05/25',
                    'cvv' => '123'
                ]
            ],
            'decline_cards' => [
                [
                    'name' => 'Visa Declined',
                    'number' => '4000000000000002',
                    'expiry' => '05/25',
                    'cvv' => '123'
                ],
                [
                    'name' => 'Insufficient Funds',
                    'number' => '4000000000000119',
                    'expiry' => '05/25',
                    'cvv' => '123'
                ]
            ]
        ];
    }

    private function addContactsToUser($payment)
    {
        // Create or update subscription
        $subscription = Subscription::updateOrCreate(
            ['user_id' => $payment->user_id],
            [
                'package_id' => $payment->package_id,
                'contacts_remaining' => $payment->package->contact_limit,
                'status' => 'active'
            ]
        );
    }
}