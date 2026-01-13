<?php

namespace App\Http\Controllers;

use App\Models\PaymentTransaction;
use App\Models\Subscription;
use App\Models\SubscriptionPackage;
use App\Models\User;
use App\Models\UserPayment;
use App\Services\FintesaPaymentService;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FintesaWebhookController extends Controller
{
    // public function handle(Request $request, FintesaPaymentService $paymentService)
    // {
    //     $payload = $request->all();

    //     // TODO: Validate signature when Fintesa provides a signing scheme
    //     Log::info('Fintesa webhook received', $payload);

    //     $parsed = $paymentService->handleWebhook($payload);

    //     if (($parsed['status'] ?? null) !== 'success') {
    //         return response()->json(['message' => 'Ignored non-success event'], 200);
    //     }

    //     $userId = $parsed['userId'] ?? null;
    //     $packageId = $parsed['packageId'] ?? null;

    //     if (!$userId || !$packageId) {
    //         Log::warning('Webhook missing required metadata', ['parsed' => $parsed]);
    //         return response()->json(['message' => 'Missing metadata'], 400);
    //     }

    //     $package = SubscriptionPackage::find($packageId);
    //     if (!$package) {
    //         return response()->json(['message' => 'Package not found'], 404);
    //     }

    //     // Increment purchase count and check if we need to recreate the product
    //     $package->increment('purchase_count');

    //     // Check if we're approaching the quantity limit (90 out of 99)
    //     try {
    //         $recreateResult = $paymentService->checkAndRecreateProduct($package);
    //         if ($recreateResult['recreated'] ?? false) {
    //             Log::info('Product recreated with fresh quantity', [
    //                 'package_id' => $package->id,
    //                 'new_product_id' => $recreateResult['product_id'] ?? null
    //             ]);
    //         }
    //     } catch (\Exception $e) {
    //         Log::error('Failed to check/recreate product', ['error' => $e->getMessage()]);
    //     }

    //     DB::transaction(function () use ($package, $userId, $parsed) {
    //         // Record payment transaction
    //         PaymentTransaction::create([
    //             'user_id' => $userId,
    //             'subscription_id' => null, // will be linked below when created
    //             // Fintesa amount treated as major currency units per observed behavior
    //             'amount' => (float) ($parsed['amount'] ?? 0),
    //             'currency' => $parsed['currency'] ?? 'USD',
    //             'payment_method' => 'fintesa',
    //             'transaction_status' => 'success',
    //             'payment_gateway_response' => json_encode($parsed),
    //         ]);

    //         // Create subscription based on gender but both as one-time payments
    //         if ($package->gender === 'male') {
    //             // One-time contact package: create subscription with no duration, only contacts
    //             $subscription = Subscription::create([
    //                 'user_id' => $userId,
    //                 'package_id' => $package->id,
    //                 'start_date' => null,
    //                 'end_date' => null,
    //                 'contacts_remaining' => (int) $package->contact_limit,
    //                 'status' => 'active',
    //             ]);
    //         } else {
    //             // Female one-time: month-based duration without auto-renewal
    //             $start = Carbon::now();
    //             $end = $package->duration ? $start->copy()->addDays((int) $package->duration) : $start->copy()->addMonth();

    //             $existing = Subscription::where('user_id', $userId)
    //                 ->where('status', 'active')
    //                 ->where('end_date', '>', now())
    //                 ->first();

    //             if ($existing) {
    //                 // Extend existing subscription
    //                 $existing->update([
    //                     'package_id' => $package->id,
    //                     'end_date' => Carbon::parse($existing->end_date)->addDays((int) $package->duration ?: 30),
    //                     'contacts_remaining' => ($existing->contacts_remaining ?? 0) + (int) ($package->contact_limit ?? 0),
    //                 ]);
    //             } else {
    //                 // Create new one-month subscription
    //                 Subscription::create([
    //                     'user_id' => $userId,
    //                     'package_id' => $package->id,
    //                     'start_date' => $start,
    //                     'end_date' => $end,
    //                     'contacts_remaining' => (int) ($package->contact_limit ?? 0),
    //                     'status' => 'active',
    //                 ]);
    //             }
    //         }
    //     });

    //     return response()->json(['message' => 'Processed'], 200);
    // }
    public function handle(Request $request, NotificationService $notificationService)
    {
        try {
            // Get payload
            $payload = $request->all();
            Log::info('Fintesa Webhook Received', $payload);

            // Extract charge data
            $charge = $payload['charge_data'] ?? null;
            if (!$charge) {
                Log::warning('Missing charge_data in webhook');
                return response()->json(['message' => 'Missing charge_data'], 400);
            }

            // Extract required fields
            $email = $charge['billing_details']['email'] ?? null;
            $amount = $charge['amount'] ?? 0;
            $prodId = trim($charge['prod_id'] ?? '');
            $status = $charge['status'] ?? 'pending';
            // dd($prodId);
            // Validate
            if (!$email || !$prodId) {
                Log::warning('Webhook missing email or prod_id', compact('email', 'prodId'));
                return response()->json(['message' => 'Missing required data'], 400);
            }

            // Find related subscription package by product ID
            $package = SubscriptionPackage::where('fintesa_product_id', $prodId)->first();
            // dd($package);
            if (!$package) {
                Log::error('Package not found for given prod_id', ['prod_id' => $prodId]);
                return response()->json(['message' => 'Package not found'], 404);
            }

            // 🔍 Check for matching record in check_user_payments
            $checkRecord = \App\Models\CheckUserPayment::where('email', $email)->first();
            $userId = $checkRecord ? $checkRecord->user_id : 999999999;
            // dd();
            // 💾 Create payment record
            \App\Models\UserPayment::create([
                'user_id' => $userId,
                'package_id' => $package->id,
                'email' => $email,
                'amount' => (float) $amount,
                'date' => now(),
                'status' => $status === 'succeeded' ? 'pending' : 'failed',
                'payment_type' => 'visa',
            ]);
            // ============================
            // ✅ NOTIFICATIONS
            // ============================

            // ✅ Notify Admins
            $admins = User::where('role_id', 1)->get(); // <-- replace with correct admin filter
            foreach ($admins as $admin) {
                $notificationService->create($admin, [
                    'notification_type' => 'fintesa_payment_webhook',
                    'target_role'       => 'admin',
                    'content_en'        => "A new Visa payment webhook was received ({$payment->status}).",
                    'content_ar'        => "تم استلام دفعة فيزا جديدة ({$payment->status}).",
                    // if you have json 'data' column:
                    // 'data' => ['payment_id' => $payment->id, 'email' => $email, 'package_id' => $package->id],
                ]);
            }

            // ✅ Notify the user only if we found a real userId
            // if ($userId) {
            //     $user = User::find($userId);
            //     if ($user) {
            //         if ($payment->status === 'pending') {
            //             $notificationService->create($user, [
            //                 'notification_type' => 'payment_received',
            //                 'target_role'       => 'user',
            //                 'content_en'        => 'We received your payment and it is pending review.',
            //                 'content_ar'        => 'تم استلام دفعتك وهي قيد المراجعة.',
            //                 // 'data' => ['payment_id' => $payment->id],
            //             ]);
            //         } else {
            //             $notificationService->create($user, [
            //                 'notification_type' => 'payment_failed',
            //                 'target_role'       => 'user',
            //                 'content_en'        => 'Your payment could not be processed.',
            //                 'content_ar'        => 'تعذر معالجة دفعتك.',
            //             ]);
            //         }
            //     }
            // }

            // ============================


            Log::info('Payment saved successfully', [
                'email' => $email,
                'package_id' => $package->id,
                'status' => $status,
            ]);

            return response()->json(['message' => 'Payment logged successfully'], 200);
        } catch (\Throwable $e) {
            Log::error('Error handling Fintesa webhook', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
