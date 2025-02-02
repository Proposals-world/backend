<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
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
                'profile.drinkingStatus',
                'profile.sportsActivity',
                'profile.socialMediaPresence',
                'profile.smokingTools', // Many-to-many relationship
                'photos',
                'hobbies', // Many-to-many relationship
                'pets', // Many-to-many relationship
            ]);
        });
    }
    public function updateProfile(User $user, array $data, string $lang)
    {
        $profile = $user->profile ?? $user->profile()->create([]);

        // Handle profile photo
        if (isset($data['profile_photo'])) {
            DB::transaction(function () use ($user, $data) {
                // Retrieve and update the current main photo
                $currentMainPhoto = $user->photos()->where('is_main', true)->first();
    
                if ($currentMainPhoto) {
                    // Delete the file from storage
                    Storage::disk('public')->delete(str_replace('/storage/', '', $currentMainPhoto->photo_url));
    
                    // Delete the old photo record from user_photos
                    $currentMainPhoto->delete();
                }
    
                // Store the new photo
                $path = $data['profile_photo']->store('profile_photos', 'public');
                $newPhotoUrl = Storage::url($path);
    
                // Create a new photo record in user_photos
                $user->photos()->create([
                    'photo_url' => $newPhotoUrl,
                    'is_main' => true, // Ensure new photo is main
                ]);
            });
        }

        // Ensure only valid fields are updated
        $profile->fill([
            'bio_en' => $data['bio_en'] ?? $profile->bio_en,
            'bio_ar' => $data['bio_ar'] ?? $profile->bio_ar,
            'date_of_birth' => $data['date_of_birth'],
            'age' => Carbon::parse($data['date_of_birth'])->age,
            'height_id' => $data['height'],
            'weight_id' => $data['weight'],
            'nationality_id' => $data['nationality_id'],
            'origin_id' => $data['origin_id'] ?? null,
            'religion_id' => $data['religion_id'],
            'skin_color_id' => $data['skin_color_id'],
            'hair_color_id' => $data['hair_color_id'],
            'country_of_residence_id' => $data['country_of_residence_id'],
            'city_id' => $data['city_id'],
            'educational_level_id' => $data['educational_level_id'],
            'specialization_id' => $data['specialization_id'] ?? null,
            'employment_status' => $data['employment_status'],
            'job_title_id' => $data['job_title_id'] ?? null,
            'smoking_status' => $data['smoking_status'] ?? null,
            'drinking_status_id' => $data['drinking_status_id'] ?? null,
            'sports_activity_id' => $data['sports_activity_id'] ?? null,
            'social_media_presence_id' => $data['social_media_presence_id'] ?? null,
            'marital_status_id' => $data['marital_status_id'],
            'children' => $data['number_of_children'] ?? null,
            'housing_status_id' => $data['housing_status_id'],
            'hijab_status' => $data['hijab_status'],
            'financial_status_id' => $data['financial_status_id'] ?? null,
            'health_issues_en' => $data['health_issues_en'] ?? null,
            'car_ownership' => $data['car_ownership'] ?? null,
            'health_issues_ar' => $data['health_issues_ar'] ?? null,
            'zodiac_sign_id' => $data['zodiac_sign_id'] ?? null,
            'guardian_contact_encrypted' => $data['guardian_contact'] ?? $profile->guardian_contact,
        ]);

        $profile->save();
        // Handle Smoking Tools based on Smoking Status
        if (isset($data['smoking_status']) && $data['smoking_status'] == 1) {
            if (isset($data['smoking_tools']) && is_array($data['smoking_tools'])) {
                $profile->smokingTools()->sync($data['smoking_tools']);
            } else {
                $profile->smokingTools()->detach();
            }
        } else {
            $profile->smokingTools()->detach();
        }

        // Sync hobbies
        $user->hobbies()->sync($data['hobbies'] ?? []);

        // Sync pets
        $user->pets()->sync($data['pets'] ?? []);

        return $user;
    }
}