<?php

namespace App\Services;

use App\Models\GuardianOtp;
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
                'profile.smokingTools', // Many-to-many relationship
                'cityLocation'
            ]);
        });
    }
    public function getAuthenticatedUserProfileFromRequest(string $lang = 'en'): ?User
    {
        $user = request()->user();

        if (!$user) {
            return null;
        }

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
        // dd($data);
        // Check if guardian_contact_encrypted has changed
        if (isset($data['guardian_contact']) && $data['guardian_contact'] !== $profile->guardian_contact_encrypted) {
            GuardianOtp::where('user_id', auth()->id())
                ->where('verified', 1)
                ->delete();
        }
        // Ensure only valid fields are updated
        $profile->fill([
            'nickname' => $data['nickname'] ?? $profile->nickname, //
            'bio_en' => $data['bio_en'] ?? $profile->bio_en, //
            'bio_ar' => $data['bio_ar'] ?? $profile->bio_ar, //
            'date_of_birth' => $data['date_of_birth'], //
            'age' => Carbon::parse($data['date_of_birth'])->age, //
            'height_id' => $data['height'], //
            'weight_id' => $data['weight'], //
            'nationality_id' => $data['nationality_id'] ?? null, //
            'origin_id' => $data['origin_id'] ?? null, //
            'religion_id' => $data['religion_id'] ?? null, //
            'skin_color_id' => $data['skin_color_id'] ?? null, //
            'hair_color_id' => $data['hair_color_id'] ?? null, //
            'country_of_residence_id' => $data['country_of_residence_id'], //
            'city_id' => $data['city_id'], //
            'city_location_id' => $data['city_location_id'] ?? null, //
            'educational_level_id' => $data['educational_level_id'], //
            'specialization_id' => $data['specialization_id'] ?? null, //
            'employment_status' => $data['employment_status'] ?? null, //
            'job_title_id' => $data['job_title_id'] ?? null, //
            'smoking_status' => $data['smoking_status'] ?? null, //
            'drinking_status_id' => $data['drinking_status_id'] ?? null, //
            'sports_activity_id' => $data['sports_activity_id'] ?? null, //
            'social_media_presence_id' => $data['social_media_presence_id'] ?? null, //missing
            'marital_status_id' => $data['marital_status_id'],  //
            'children' => $data['number_of_children'] ?? null, //
            'housing_id' => $data['housing_status_id'] ?? null, //
            'hijab_status' => $data['hijab_status'] ?? 0, //missing for wemon only
            'position_level_id' => $data['position_level_id'] ?? null,  //missing
            'financial_status_id' => $data['financial_status_id'] ?? null, //
            'health_issues_en' => $data['health_issues_en'] ?? null,
            'car_ownership' => $data['car_ownership'] ?? null, //missing
            'health_issues_ar' => $data['health_issues_ar'] ?? null,
            'zodiac_sign_id' => $data['zodiac_sign_id'] ?? null, //missing
            'religiosity_level_id' => $data['religiosity_level_id'] ?? null,  //missing
            'sleep_habit_id' => $data['sleep_habit_id'] ?? null,
            'marriage_budget_id' => $data['marriage_budget_id'] ?? null, //missing for men
            'eye_color_id' => $data['eye_color_id'] ?? null, //missing for men
            'guardian_contact_encrypted' => $data['guardian_contact'] ?? $profile->guardian_contact,
        ]);

        $profile->save();
        // Handle Smoking Tools based on Smoking Status
        if (isset($data['smoking_status']) && $data['smoking_status'] == 1) {
            if (isset($data['smoking_tools']) && is_array($data['smoking_tools'])) { // missing
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
        $user->pets()->sync($data['pets'] ?? []); // missing

        return $user;
    }

    public function updateProfilePhoto(User $user, $photoFile)
    {
        DB::transaction(function () use ($user, $photoFile) {
            // Retrieve and delete the current main photo
            $currentMainPhoto = $user->photos()->where('is_main', true)->first();

            if ($currentMainPhoto) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $currentMainPhoto->photo_url));
                $currentMainPhoto->delete();
            }

            // Store the new photo
            $path = $photoFile->store('profile_photos', 'public');
            $newPhotoUrl = Storage::url($path);

            // Create a new photo record
            $user->photos()->create([
                'photo_url' => $newPhotoUrl,
                'is_main' => true,
            ]);
        });

        return $user->refresh();
    }
}
