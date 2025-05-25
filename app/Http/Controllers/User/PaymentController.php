<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\SubscriptionPackage;
use App\Services\PaymentGatewayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function __construct(private readonly PaymentGatewayService $gateway) {}

    /**
     * GET /user/payment/checkout?package_id=…
     *
     * Creates a local Payment row ➜ requests Hosted-Checkout session
     * ➜ redirects user to gateway page.
     */
    public function checkout(Request $request)
    {
        $request->validate(['package_id' => 'required|exists:subscription_packages,id']);

        $package   = SubscriptionPackage::findOrFail($request->package_id);
        $orderId   = (string) Str::uuid();          // unique inside our DB AND gateway
        $returnUrl = route('user.payment.return', ['payment' => 0]); // 0 placeholder – fixed below

        // 1️⃣  local DB row first (so we have an id we can put in return URL)
        $payment = Payment::create([
            'user_id'        => Auth::id(),
            'package_id'     => $package->id,
            'order_id'       => $orderId,
            'transaction_id' => Str::uuid(),
            'amount'         => $package->price,
            'currency'       => 'USD',
            'status'         => 'pending',
        ]);

        // patch real return URL with the DB id
        $returnUrl = route('user.payment.return', ['payment' => $payment->id]);

        // 2️⃣  ask gateway for a Hosted-Checkout session
        $gatewayRes = $this->gateway->createCheckoutSession(
            orderId: $orderId,
            amount : $package->price,
            currency: 'USD',
            returnUrl: $returnUrl,
            operation: 'PURCHASE',
        );

        if (!$gatewayRes['success'] ||
            empty($gatewayRes['data']['session']['id'])) {
            // mark row as failed so support team can see it
            $payment->update(['status' => 'failed', 'gateway_response' => $gatewayRes['data']]);

            return back()->with('error', 'Unable to start payment – please try again.');
        }

        $sessionId  = $gatewayRes['data']['session']['id'];
        $redirect   = $this->gateway->getCheckoutUrl($sessionId);

        $payment->update(['gateway_response' => $gatewayRes['data']]);

        return redirect()->away($redirect);
    }

    /**
     * Landing page after Gateway redirects back.
     * Checks order status and updates local DB.
     */
    public function returnFromGateway(Request $request, Payment $payment)
    {
        abort_unless($payment->user_id === Auth::id(), 403);

        $orderRes = $this->gateway->retrieveOrder($payment->order_id);

        if ($orderRes['success'] &&
            ($orderRes['data']['result'] ?? null) === 'SUCCESS') {

            $payment->update([
                'status'                 => 'completed',
                'gateway_response_code'  => $orderRes['data']['response']['gatewayCode'] ?? null,
                'gateway_response'       => $orderRes['data'],
                'paid_at'                => now(),
            ]);

            // add contacts / subscription handling …
            $payment->package->activateForUser($payment->user_id);   // <— keep your own helper

            return redirect()->route('user.payment.success', $payment->id);
        }

        $payment->update([
            'status'           => 'failed',
            'gateway_response' => $orderRes['data'] ?? null,
        ]);

        return redirect()->route('user.payment.failed', $payment->id);
    }

    /* -----------------------------------------------------------------
     |  Simple views                                                     |
     * ----------------------------------------------------------------- */

    public function success(Payment $payment)
    {
        abort_unless($payment->user_id === Auth::id(), 403);
        return view('user.payment.success', compact('payment'));
    }

    public function failed(Payment $payment)
    {
        abort_unless($payment->user_id === Auth::id(), 403);
        return view('user.payment.failed', compact('payment'));
    }
}