<?php

namespace App\Observers;

use App\Helpers\LogFieldMap;
use App\Http\Resources\UserProfileResource;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Log;

class UserProfileObserver
{
    /**
     * Log after the model is updated.
     */
    public function updated(UserProfile $profile): void
    {
        $labels = LogFieldMap::labels();
        $relations = $this->relationMap();

        // Get original values before update
        $original = $profile->getOriginal();
        $current = $profile->getAttributes();

        $diff = [];

        foreach ($labels as $field => $label) {
            $old = $original[$field] ?? null;
            $new = $current[$field] ?? null;

            // Mask sensitive
            if (in_array($field, $this->sensitiveFields(), true)) {
                $old = $this->mask($old);
                $new = $this->mask($new);
            }

            // Convert related models to readable names
            $old = $this->resolveValue($field, $old);
            $new = $this->resolveValue($field, $new);

            // Normalize (convert array/boolean/etc. to readable strings)
            $old = $this->normalize($old);
            $new = $this->normalize($new);

            // Produce "No Change"
            if ($old === $new) {
                $diff[$label] = "No Change";
            } else {
                $diff[$label] = [
                    'old' => $old,
                    'new' => $new,
                ];
            }
        }

        // Full snapshot BEFORE update (human readable)
        $snapshot = new UserProfileResource($profile->user, app()->getLocale());
        $snapshot = $snapshot->toArray(request());

        Log::channel('user_profile')->info('Profile updated', [
            'user_id'  => $profile->id,
            'actor_id' => optional(auth()->user())->id,
            'snapshot_before_update' => $snapshot,
            'diff'     => $diff,
            'at'       => now()->toIso8601String(),
            'ip'       => request()?->ip(),
            'url'      => request()?->fullUrl(),
        ]);
    }

    /**
     * Optional: log creation.
     */
    public function created(UserProfile $profile): void
    {
        Log::channel('user_profile')->info('User profile created', [
            'user_id'  => $profile->id,
            'actor_id' => optional(auth()->user())->id,
            'snapshot' => $this->snapshot($profile),
            'at'       => now()->toIso8601String(),
            'ip'       => request()?->ip(),
            'url'      => request()?->fullUrl(),
        ]);
    }

    /**
     * Optional: log deletion.
     */
    public function deleted(UserProfile $profile): void
    {
        Log::channel('user_profile')->warning('User profile deleted', [
            'user_id'  => $profile->id,
            'actor_id' => optional(auth()->user())->id,
            'at'       => now()->toIso8601String(),
            'ip'       => request()?->ip(),
            'url'      => request()?->fullUrl(),
        ]);
    }

    private function sensitiveFields(): array
    {
        return [
            'guardian_contact_encrypted',
            'id_number',
            'avatar_url',
            'criminal_record_url',
        ];
    }

    private function mask($value): string
    {
        if (empty($value)) return '';
        $str = (string) $value;
        $len = mb_strlen($str);
        if ($len <= 4) return str_repeat('*', $len);
        return mb_substr($str, 0, 2) . str_repeat('*', max(0, $len - 4)) . mb_substr($str, -2);
    }

    private function normalize($value)
    {
        if (is_bool($value)) return $value ? 'true' : 'false';
        if (is_array($value) || is_object($value)) return json_encode($value, JSON_UNESCAPED_UNICODE);
        return $value;
    }

    private function snapshot(UserProfile $p): array
    {
        $data = $p->toArray();
        foreach ($this->sensitiveFields() as $f) {
            if (array_key_exists($f, $data)) {
                $data[$f] = $this->mask($data[$f]);
            }
        }
        return $data;
    }
    private function relationMap(): array
    {
        return [
            'city_location_id'      => \App\Models\CityLocation::class,
            'city_id'               => \App\Models\City::class,
            'zodiac_sign_id'        => \App\Models\ZodiacSign::class,
            'position_level_id'     => \App\Models\PositionLevel::class,
            'housing_id'            => \App\Models\HousingStatus::class,
            'religiosity_level_id'  => \App\Models\ReligiosityLevel::class,
            'marriage_budget_id'    => \App\Models\MarriageBudget::class,
            'eye_color_id'          => \App\Models\EyeColor::class,

            // Add more if needed:
            'nationality_id'        => \App\Models\Nationality::class,
            'origin_id'             => \App\Models\Origin::class,
            'religion_id'           => \App\Models\Religion::class,
            'country_of_residence_id' => \App\Models\Country::class,
            'educational_level_id'  => \App\Models\EducationalLevel::class,
            'specialization_id'     => \App\Models\Specialization::class,
            'job_title_id'          => \App\Models\JobTitle::class,
            'sector_id'             => \App\Models\Sector::class,
            'financial_status_id'   => \App\Models\FinancialStatus::class,
            'height_id'             => \App\Models\Height::class,
            'weight_id'             => \App\Models\Weight::class,
            'marital_status_id'     => \App\Models\MaritalStatus::class,
            'skin_color_id'         => \App\Models\SkinColor::class,
            'hair_color_id'         => \App\Models\HairColor::class,
            'drinking_status_id'    => \App\Models\DrinkingStatus::class,
            'sports_activity_id'    => \App\Models\SportsActivity::class,
            'social_media_presence_id' => \App\Models\SocialMediaPresence::class,
            'sleep_habit_id'        => \App\Models\SleepHabit::class,
        ];
    }
    private function resolveValue($field, $value)
    {
        if (is_null($value)) return null;

        $map = $this->relationMap();

        if (array_key_exists($field, $map)) {
            $model = $map[$field];
            $record = $model::find($value);

            if (!$record) return $value;

            $locale = app()->getLocale();

            // Priority order based on locale
            $candidates = $locale === 'ar'
                ? ['name_ar', 'title_ar', 'label_ar', 'value_ar', 'budget_ar', 'description_ar', 'name', 'title', 'label', 'value', 'description']
                : ['name_en', 'title_en', 'label_en', 'value_en', 'budget_en', 'description_en', 'name', 'title', 'label', 'value', 'description'];

            foreach ($candidates as $col) {
                if (isset($record->$col) && $record->$col !== null && $record->$col !== '') {
                    return $record->$col;
                }
            }

            return (string) $value;
        }

        return $value;
    }
}
