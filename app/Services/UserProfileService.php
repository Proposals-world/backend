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
    public function     getAuthenticatedUserProfile(User $user, string $lang = 'en'): ?User
    {
        // Validate language parameter
        $lang = in_array($lang, ['en', 'ar']) ? $lang : 'en';

        // Optionally, cache the profile data to optimize performance
        return Cache::remember("user_profile_{$user->id}_{$lang}", 60, function () use ($user) {
            return $user->load([
                'profile.nationality',
                'profile.origin',
                'profile.religion',
                'profile.religiosityLevel',
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
        // Check if guardian_contact_encrypted has changed
        // Handle guardian contact safely
        $guardianContact = $data['_guardian_full'] ?? $profile->guardian_contact_encrypted ?? null;
        if ($guardianContact && $user->phone_number == $guardianContact) {
            return [
                'error' => __('profile.guardian_contact_same_as_phone'),
            ];
        }
        if (isset($data['guardian_contact']) && $guardianContact !== $profile->guardian_contact_encrypted) {
            GuardianOtp::where('user_id', auth()->id())
                ->where('verified', 1)
                ->delete();
        }
        // Check if guardian_contact is the same as user's phone number

        // dd($user->phone_number, $data['_guardian_full']);
        // dd($data['guardian_contact']);
        // dd($user->phone_number, $data['_guardian_full']);

        // Ensure only valid fields are updated
        $profile->fill([
            'nickname' => $data['nickname'] ?? ($profile->nickname ?? null),
            'bio_en' => $data['bio_en'] ?? ($profile->bio_en ?? null),
            'bio_ar' => $data['bio_ar'] ?? ($profile->bio_ar ?? null),
            'date_of_birth' => $data['date_of_birth'] ?? ($profile->date_of_birth ?? null),
            'age' => isset($data['date_of_birth']) && !empty($data['date_of_birth'])
                ? Carbon::parse($data['date_of_birth'])->age
                : ($profile->age ?? null),
            'height_id' => $data['height'] ?? ($profile->height_id ?? null),
            'weight_id' => $data['weight'] ?? ($profile->weight_id ?? null),
            'nationality_id' => $data['nationality_id'] ?? ($profile->nationality_id ?? null),
            'origin_id' => $data['origin_id'] ?? ($profile->origin_id ?? null),
            'religion_id' => $data['religion_id'] ?? ($profile->religion_id ?? null),
            'skin_color_id' => $data['skin_color_id'] ?? ($profile->skin_color_id ?? null),
            'hair_color_id' => $data['hair_color_id'] ?? ($profile->hair_color_id ?? null),
            'country_of_residence_id' => $data['country_of_residence_id'] ?? ($profile->country_of_residence_id ?? null),
            'city_id' => $data['city_id'] ?? ($profile->city_id ?? null),
            'city_location_id' => $data['city_location_id'] ?? ($profile->city_location_id ?? null),
            'educational_level_id' => $data['educational_level_id'] ?? ($profile->educational_level_id ?? null),
            'specialization_id' => $data['specialization_id'] ?? ($profile->specialization_id ?? null),
            'employment_status' => $data['employment_status'] ?? ($profile->employment_status ?? null),
            'job_title_id' => $data['job_title_id'] ?? ($profile->job_title_id ?? null),
            'smoking_status' => $data['smoking_status'] ?? ($profile->smoking_status ?? null),
            'drinking_status_id' => $data['drinking_status_id'] ?? ($profile->drinking_status_id ?? null),
            'sports_activity_id' => $data['sports_activity_id'] ?? ($profile->sports_activity_id ?? null),
            'social_media_presence_id' => $data['social_media_presence_id'] ?? ($profile->social_media_presence_id ?? null),
            'marital_status_id' => $data['marital_status_id'] ?? ($profile->marital_status_id ?? null),
            'children' => $data['number_of_children'] ?? ($profile->children ?? null),
            'housing_id' => $data['housing_status_id'] ?? ($profile->housing_id ?? null),
            'hijab_status' => $data['hijab_status'] ?? ($profile->hijab_status ?? null),
            'position_level_id' => $data['position_level_id'] ?? ($profile->position_level_id ?? null),
            'financial_status_id' => $data['financial_status_id'] ?? ($profile->financial_status_id ?? null),
            'health_issues_en' => $data['health_issues_en'] ?? ($profile->health_issues_en ?? null),
            'car_ownership' => $data['car_ownership'] ?? ($profile->car_ownership ?? null),
            'health_issues_ar' => $data['health_issues_ar'] ?? ($profile->health_issues_ar ?? null),
            'zodiac_sign_id' => $data['zodiac_sign_id'] ?? ($profile->zodiac_sign_id ?? null),
            'religiosity_level_id' => $data['religiosity_level_id'] ?? ($profile->religiosity_level_id ?? null),
            'sleep_habit_id' => $data['sleep_habit_id'] ?? ($profile->sleep_habit_id ?? null),
            'marriage_budget_id' => $data['marriage_budget_id'] ?? ($profile->marriage_budget_id ?? null),
            'eye_color_id' => $data['eye_color_id'] ?? ($profile->eye_color_id ?? null),
            'guardian_contact_encrypted' => $guardianContact ?? ($profile->guardian_contact_encrypted ?? null),
        ]);


        $profile->save();
        $user->load('profile');

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
