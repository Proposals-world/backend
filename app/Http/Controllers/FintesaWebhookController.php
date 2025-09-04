<?php

namespace App\Http\Controllers;

use App\Models\PaymentTransaction;
use App\Models\Subscription;
use App\Models\SubscriptionPackage;
use App\Services\FintesaPaymentService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FintesaWebhookController extends Controller
{
    public function handle(Request $request, FintesaPaymentService $paymentService)
    {
        $payload = $request->all();

        // TODO: Validate signature when Fintesa provides a signing scheme
        Log::info('Fintesa webhook received', $payload);

        $parsed = $paymentService->handleWebhook($payload);

        if (($parsed['status'] ?? null) !== 'success') {
            return response()->json(['message' => 'Ignored non-success event'], 200);
        }

        $userId = $parsed['userId'] ?? null;
        $packageId = $parsed['packageId'] ?? null;

        if (!$userId || !$packageId) {
            Log::warning('Webhook missing required metadata', ['parsed' => $parsed]);
            return response()->json(['message' => 'Missing metadata'], 400);
        }

        $package = SubscriptionPackage::find($packageId);
        if (!$package) {
            return response()->json(['message' => 'Package not found'], 404);
        }
        
        // Increment purchase count and check if we need to recreate the product
        $package->increment('purchase_count');
        
        // Check if we're approaching the quantity limit (90 out of 99)
        try {
            $recreateResult = $paymentService->checkAndRecreateProduct($package);
            if ($recreateResult['recreated'] ?? false) {
                Log::info('Product recreated with fresh quantity', [
                    'package_id' => $package->id, 
                    'new_product_id' => $recreateResult['product_id'] ?? null
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Failed to check/recreate product', ['error' => $e->getMessage()]);
        }

        DB::transaction(function () use ($package, $userId, $parsed) {
            // Record payment transaction
            PaymentTransaction::create([
                'user_id' => $userId,
                'subscription_id' => null, // will be linked below when created
                // Fintesa amount treated as major currency units per observed behavior
                'amount' => (float) ($parsed['amount'] ?? 0),
                'currency' => $parsed['currency'] ?? 'USD',
                'payment_method' => 'fintesa',
                'transaction_status' => 'success',
                'payment_gateway_response' => json_encode($parsed),
            ]);

            // Create subscription based on gender but both as one-time payments
            if ($package->gender === 'male') {
                // One-time contact package: create subscription with no duration, only contacts
                $subscription = Subscription::create([
                    'user_id' => $userId,
                    'package_id' => $package->id,
                    'start_date' => null,
                    'end_date' => null,
                    'contacts_remaining' => (int) $package->contact_limit,
                    'status' => 'active',
                ]);
            } else {
                // Female one-time: month-based duration without auto-renewal
                $start = Carbon::now();
                $end = $package->duration ? $start->copy()->addDays((int) $package->duration) : $start->copy()->addMonth();

                $existing = Subscription::where('user_id', $userId)
                    ->where('status', 'active')
                    ->where('end_date', '>', now())
                    ->first();

                if ($existing) {
                    // Extend existing subscription
                    $existing->update([
                        'package_id' => $package->id,
                        'end_date' => Carbon::parse($existing->end_date)->addDays((int) $package->duration ?: 30),
                        'contacts_remaining' => ($existing->contacts_remaining ?? 0) + (int) ($package->contact_limit ?? 0),
                    ]);
                } else {
                    // Create new one-month subscription
                    Subscription::create([
                        'user_id' => $userId,
                        'package_id' => $package->id,
                        'start_date' => $start,
                        'end_date' => $end,
                        'contacts_remaining' => (int) ($package->contact_limit ?? 0),
                        'status' => 'active',
                    ]);
                }
            }
        });

        return response()->json(['message' => 'Processed'], 200);
    }
}

