<?php

namespace App\Services;

use App\Models\Subscription;
use App\Models\SubscriptionPackage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SubscriptionService
{
    /**
     * Create or renew a subscription for a user
     *
     * @param int $userId
     * @param int $packageId
     * @return Subscription
     */
    public function createOrRenew(int $userId, int $packageId): Subscription
    {
        $package = SubscriptionPackage::findOrFail($packageId);

        $existingSubscription = Subscription::where('user_id', $userId)
            ->where('end_date', '>', now())
            ->first();

        $startDate = Carbon::now();

        if ($existingSubscription) {
            $endDate = Carbon::parse($existingSubscription->end_date)
                ->addDays($package->duration);

            $existingSubscription->update([
                'package_id' => $package->id,
                'end_date' => $endDate,
                'contacts_remaining' => $existingSubscription->contacts_remaining + $package->contact_limit,
                'status' => 'active'
            ]);

            return $existingSubscription;
        } else {
            $endDate = $startDate->copy()->addDays($package->duration);

            return Subscription::create([
                'user_id' => $userId,
                'package_id' => $package->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'contacts_remaining' => $package->contact_limit,
                'status' => 'active'
            ]);
        }
    }
}
