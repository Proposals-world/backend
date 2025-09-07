<?php

namespace App\Services;

use App\Models\User;
use App\Models\Subscription;
use App\Models\SubscriptionPackage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRegistrationFreeSubsService
{


    public function assignFreeSubscription(User $user): void
    {

        if ($user->gender === 'female') {
            // Female: 30-day subscription
            Subscription::create([
                'user_id' => $user->id,
                'package_id' => 1, // optional, can leave null if not using a package
                'start_date' => now(),
                'end_date' => now()->addDays(30), // exactly 30 days
                'contacts_remaining' => 0,        // no contacts limit
                'status' => 'active',
            ]);
        } elseif ($user->gender === 'male') {
            // Male: 1 contact free
            Subscription::create([
                'user_id' => $user->id,
                'package_id' => 1, // optional
                'start_date' => now(),
                'end_date' => null,          // no expiry
                'contacts_remaining' => 1,   // exactly 1 contact
                'status' => 'active',
            ]);
        }
    }
}
