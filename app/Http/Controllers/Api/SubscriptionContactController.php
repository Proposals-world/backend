<?php

namespace App\Http\Controllers\Api;

use App\Models\Subscription;
use App\Models\SubscriptionPackage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SubscriptionContactController extends Controller
{
    // Create or renew a subscription
    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:subscription_packages,id'
        ]);

        // Get the package
        $package = SubscriptionPackage::findOrFail($request->package_id);

        // Check for existing active subscription
        $existingSubscription = Subscription::where('user_id', Auth::id())
            ->where('status', 'active')
            ->where('end_date', '>', now())
            ->first();

        $startDate = Carbon::now();

        // Calculate end date based on whether there's an existing subscription
        if ($existingSubscription) {
            // Renew by adding to the existing end date
            $endDate = Carbon::parse($existingSubscription->end_date)
                ->addDays($package->duration);

            // Update existing subscription
            $existingSubscription->update([
                'package_id' => $package->id,
                'end_date' => $endDate,
                'contacts_remaining' => $existingSubscription->contacts_remaining + $package->contact_limit,
                'status' => 'active'
            ]);

            $subscription = $existingSubscription;
        } else {
            // Create new subscription
            $endDate = $startDate->copy()->addDays($package->duration);

            $subscription = Subscription::create([
                'user_id' => Auth::id(),
                'package_id' => $package->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'contacts_remaining' => $package->contact_limit,
                'status' => 'active'
            ]);
        }

        return response()->json([
            'message' => $existingSubscription ? 'Subscription renewed successfully' : 'Subscription created successfully',
            'subscription' => $subscription,
            'contacts_remaining' => $subscription->contacts_remaining,
            'expires_at' => $endDate->toDateTimeString()
        ], 201);
    }

    // Get current subscription info
    public function show()
    {
        $subscription = Subscription::with('package')
            ->where('user_id', Auth::id())
            ->where('status', 'active')
            ->where('end_date', '>', now())
            ->first();

        if (!$subscription) {
            return response()->json([
                'message' => 'No active subscription found'
            ], 404);
        }

        return response()->json([
            'subscription_id' => $subscription->id,
            'package_name' => $subscription->package->package_name_en,
            'contacts_remaining' => $subscription->contacts_remaining,
            'expires_at' => $subscription->end_date,
            'status' => $subscription->status
        ]);
    }
}
