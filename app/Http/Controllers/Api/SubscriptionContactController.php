<?php

namespace App\Http\Controllers\Api;

use App\Models\Subscription;
use App\Models\SubscriptionPackage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Services\SubscriptionService;

class SubscriptionContactController extends Controller
{
    protected $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }
    // Create or renew a subscription
    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:subscription_packages,id'
        ]);

        // Get the currently authenticated user ID
        $userId = Auth::id();

        // Call the service
        $subscription = $this->subscriptionService->createOrRenew($userId, $request->package_id);

        return response()->json([
            'message' => request()->header('Accept-Language') === 'ar' ? 'تمت معالجة الاشتراك بنجاح' : 'Subscription processed successfully',
            'subscription' => $subscription,
            'contacts_remaining' => $subscription->contacts_remaining,
            'expires_at' => $subscription->end_date->toDateTimeString(),
        ], 201);
    }


    // Get current subscription info
    public function show()
    {
        $subscription = Subscription::with('package')
            ->where('user_id', Auth::id())
            // ->where('status', 'active')
            // ->where('end_date', '>', now())
            ->first();
        // dd($subscription);
        if (!$subscription) {
            return response()->json([
                'message' => 'No active subscription found'
            ], 404);
        }
        if ($subscription->package->gender === 'male') {
            return response()->json([
                'subscription_id' => $subscription->id,
                'package_name' => $subscription->package->package_name_en,
                'contacts_remaining' => $subscription->contacts_remaining,
                // 'expires_at' => $subscription->end_date,
                // 'status' => $subscription->status
            ]);
        } else {
            return response()->json([
                'subscription_id' => $subscription->id,
                'package_name' => $subscription->package->package_name_en,
                // 'contacts_remaining' => $subscription->contacts_remaining,
                'expires_at' => $subscription->end_date,
                // 'status' => $subscription->status
            ]);
        }
    }
}
