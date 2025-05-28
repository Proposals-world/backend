<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\PaymentReceipt;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\SubscriptionPackage;
use App\Services\PaymentGatewayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function __construct(private readonly PaymentGatewayService $gateway) {}

    /** Step 1-3 — Start checkout and redirect to MPGS page. */
    public function checkout(Request $request)
    {
        $request->validate(['package_id' => 'required|exists:subscription_packages,id']);

        $package = SubscriptionPackage::findOrFail($request->package_id);
        $orderId = (string) Str::uuid();     // must be unique per order
        $payment = Payment::create([
            'user_id'        => Auth::id(),
            'package_id'     => $package->id,
            'order_id'       => $orderId,
            'transaction_id' => Str::uuid(),
            'amount'         => $package->price,
            'currency'       => 'USD',
            'status'         => 'pending',
        ]);

        $returnUrl = route('user.payment.return', $payment);

        // Step 2 — request hosted-checkout session
        $res = $this->gateway->createCheckoutSession(
            orderId    : $orderId,
            amount     : $package->price,
            currency   : 'USD',
            returnUrl  : $returnUrl,
            description: "Package: {$package->{'package_name_' . app()->getLocale()}}"
        );

        if (!($res['success'] && ($sessionId = $res['data']['session']['id'] ?? null))) {
            $payment->update(['status' => 'failed', 'gateway_response' => $res['data']]);
            return back()->with('error', __('Unable to start payment. Please try again.'));
        }

        // store whole response for audit
        $payment->update(['gateway_response' => $res['data']]);

        // Step 3 — show checkout page
        return view('user.payment.redirect', [
            'baseUrl'    => config('services.payment_gateway.base_url'),
            'sessionId'  => $sessionId,
            'orderId'    => $orderId,
        ]);
    }

    /** Step 6-9 — Return URL hits here; confirm result with MPGS API. */
    public function returnFromGateway(Request $request, Payment $payment)
    {
        abort_unless($payment->user_id === Auth::id(), 403);

        // Step 7-8 — Query the order status directly
        $res = $this->gateway->retrieveOrder($payment->order_id);

        if ($res['success'] && ($res['data']['result'] ?? null) === 'SUCCESS') {
            $payment->update([
                'status'                => 'completed',
                'gateway_response_code' => $res['data']['response']['gatewayCode'] ?? null,
                'gateway_response'      => $res['data'],
                'paid_at'              => now(),
            ]);

            // Create subscription using the model method
            Subscription::createFromPayment($payment);

            // Send receipt email automatically
            $this->sendReceiptEmail($payment);

            return redirect()->route('user.payment.success', $payment);
        }

        $payment->update([
            'status'           => 'failed',
            'gateway_response' => $res['data'] ?? null,
        ]);

        return redirect()->route('user.payment.failed', $payment);
    }

    /**
     * Send receipt email manually
     */
    public function emailReceipt(Payment $payment)
    {
        abort_unless($payment->user_id === Auth::id(), 403);
        
        $this->sendReceiptEmail($payment);
        
        return back()->with('success', __('Receipt has been sent to your email.'));
    }

    /**
     * Helper method to send receipt email
     */
    private function sendReceiptEmail(Payment $payment): void
    {
        Mail::to($payment->user->email)
            ->send(new PaymentReceipt($payment));
    }

    /* Simple result pages -------------------------------------------------- */

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