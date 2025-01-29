<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserProfileService
{
    /**
     * Retrieve authenticated user's basic and profile data.
     *
     * @param User $user
     * @param string $lang
     * @return User|null
     */
    public function getAuthenticatedUserProfile(User $user, string $lang = 'en'): ?User
    {
        // Validate language parameter
        $lang = in_array($lang, ['en', 'ar']) ? $lang : 'en';

        // Optionally, cache the profile data to optimize performance
        return Cache::remember("user_profile_{$user->id}_{$lang}", 60, function () use ($user) {
            return $user->load([
                'profile.nationality',
                'profile.origin',
                'profile.religion',
                'profile.countryOfResidence',
                'profile.city',
                'profile.zodiacSign',
                'profile.educationalLevel',
                'profile.specialization',
                'profile.jobTitle',
                'profile.positionLevel',
                'profile.financialStatus',
                'profile.housingStatus',
                'profile.height',
                'profile.weight',
                'profile.maritalStatus',
                'profile.skinColor',
                'profile.hairColor',
                'profile.hijabStatus',
                'profile.smokingStatus',
                'profile.drinkingStatus',
                'profile.sportsActivity',
                'profile.socialMediaPresence',
                'photos',
            ]);
        });
    }
}