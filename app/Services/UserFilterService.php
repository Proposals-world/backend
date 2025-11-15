<?php

namespace App\Services;

use App\Http\Resources\FilteredUserResource;
use App\Models\Dislike;
use App\Models\Like;
use App\Models\UserProfile;
use App\Models\UserPreference;
use App\Models\UserReport;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserFilterService
{
    public function filter(Request $request)
    {
        $preferences   = UserPreference::where('user_id', Auth::id())->first();
        $isFromFilter  = $request->input('isFilter', false);
        $hasUserProfile = UserProfile::where('id', Auth::id())->exists();

        $reportedUsers = UserReport::where('reporter_id', Auth::id())->pluck('reported_id');

        $baseQuery = UserProfile::with(['user', 'user.photos', 'user.pets', 'smokingTools'])
            ->whereNotNull('nickname') // Exclude profiles without nickname
            ->whereHas('user', function ($subQ) {
                $subQ->where('gender', '!=', Auth::user()->gender)
                    ->where('role_id', '!=', 1)
                    ->where('status', 'active');
            });

        //  dd($baseQuery->count());
        $likedUsers    = Like::where('user_id', Auth::id())->pluck('liked_user_id');
        $dislikedUsers = Dislike::where('user_id', Auth::id())->pluck('disliked_user_id');
        $baseQuery->whereNotIn('user_profiles.id', $likedUsers)
            ->whereNotIn('user_profiles.id', $dislikedUsers)
            ->whereNotIn('user_profiles.id', $reportedUsers);
        if (!$isFromFilter) {
            // When isFilter = false, use ONLY the user's saved preferences.
            // We explicitly pull out only the non-null preferences and build the filters array.
            $filters = [];
            if ($preferences) {
                if (!is_null($preferences->preferred_nationality_id)) {
                    $filters['nationality_id'] = $preferences->preferred_nationality_id;
                }
                if (!is_null($preferences->preferred_origin_id)) {
                    $filters['origin_id'] = $preferences->preferred_origin_id;
                }
                if (!is_null($preferences->preferred_country_id)) {
                    $filters['country_of_residence_id'] = $preferences->preferred_country_id;
                }
                if (!is_null($preferences->preferred_city_id)) {
                    $filters['city_id'] = $preferences->preferred_city_id;
                }
                if (!is_null($preferences->preferred_educational_level_id)) {
                    $filters['educational_level_id'] = $preferences->preferred_educational_level_id;
                }
                if (!is_null($preferences->preferred_specialization_id)) {
                    $filters['specialization_id'] = $preferences->preferred_specialization_id;
                }
                if (!is_null($preferences->preferred_employment_status)) {
                    $filters['employment_status'] = $preferences->preferred_employment_status;
                }
                if (!is_null($preferences->preferred_job_title_id)) {
                    $filters['job_title_id'] = $preferences->preferred_job_title_id;
                }
                if (!is_null($preferences->preferred_financial_status_id)) {
                    $filters['financial_status_id'] = $preferences->preferred_financial_status_id;
                }
                if (!is_null($preferences->preferred_height_id)) {
                    $filters['height_id'] = $preferences->preferred_height_id;
                }
                if (!is_null($preferences->preferred_weight_id)) {
                    $filters['weight_id'] = $preferences->preferred_weight_id;
                }
                if (!is_null($preferences->preferred_marital_status_id)) {
                    $filters['marital_status_id'] = $preferences->preferred_marital_status_id;
                }
                if (!is_null($preferences->preferred_smoking_status)) {
                    $filters['smoking_status'] = $preferences->preferred_smoking_status;
                }
                if (!is_null($preferences->preferred_drinking_status_id)) {
                    $filters['drinking_status_id'] = $preferences->preferred_drinking_status_id;
                }
                if (!is_null($preferences->preferred_sports_activity_id)) {
                    $filters['sports_activity_id'] = $preferences->preferred_sports_activity_id;
                }
                if (!is_null($preferences->preferred_social_media_presence_id)) {
                    $filters['social_media_presence_id'] = $preferences->preferred_social_media_presence_id;
                }
                if (!is_null($preferences->preferred_sleep_habit_id)) {
                    $filters['sleep_habit_id'] = $preferences->preferred_sleep_habit_id;
                }
                if (!is_null($preferences->preferred_language_id)) {
                    $filters['language_id'] = $preferences->preferred_language_id;
                }
                if (!is_null($preferences->preferred_marriage_budget_id)) {
                    $filters['marriage_budget_id'] = $preferences->preferred_marriage_budget_id;
                }
                if (!is_null($preferences->preferred_religion_id)) {
                    $filters['religion_id'] = $preferences->preferred_religion_id;
                }
                if (!is_null($preferences->preferred_religiosity_level_id)) {
                    $filters['religiosity_level_id'] = $preferences->preferred_religiosity_level_id;
                }
                if (!is_null($preferences->preferred_children)) {
                    $filters['children'] = $preferences->preferred_children;
                }

                // New added filters
                if (!is_null($preferences->preferred_sector_id)) {
                    $filters['sector_id'] = $preferences->preferred_sector_id;
                }
                if (!is_null($preferences->preferred_position_level_id)) {
                    $filters['position_level_id'] = $preferences->preferred_position_level_id;
                }
                if (!is_null($preferences->preferred_housing_id)) {
                    $filters['housing_id'] = $preferences->preferred_housing_id;
                }
                if (!is_null($preferences->preferred_car_ownership)) {
                    $filters['car_ownership'] = $preferences->preferred_car_ownership;
                }
                if (!is_null($preferences->preferred_zodiac_sign_id)) {
                    $filters['zodiac_sign_id'] = $preferences->preferred_zodiac_sign_id;
                }
                if (!is_null($preferences->preferred_skin_color_id)) {
                    $filters['skin_color_id'] = $preferences->preferred_skin_color_id;
                }
                if (!is_null($preferences->preferred_hair_color_id)) {
                    $filters['hair_color_id'] = $preferences->preferred_hair_color_id;
                }
                if (!is_null($preferences->preferred_eye_color_id)) {
                    $filters['eye_color_id'] = $preferences->preferred_eye_color_id;
                }
                if (!is_null($preferences->preferred_hijab_status)) {
                    $filters['hijab_status'] = $preferences->preferred_hijab_status;
                }
                if (!is_null($preferences->preferred_city_location_id)) {
                    $filters['city_location_id'] = $preferences->preferred_city_location_id;
                }
                if (!is_null($preferences->preferred_area)) {
                    $filters['area'] = $preferences->preferred_area;
                }
            } else {
                $filters = [];
            }

            // Use only saved preferences for age range.
            $ageMin = $preferences ? $preferences->preferred_age_min : null;
            $ageMax = $preferences ? $preferences->preferred_age_max : null;
        } else {
            $filters = [];

            // Merge logic: use request values if present, otherwise fallback to preferences
            $filters['nationality_id']           = $request->filled('nationality_id')           ? $request->input('nationality_id')           : $preferences?->preferred_nationality_id;
            $filters['origin_id']                = $request->filled('origin_id')                ? $request->input('origin_id')                : $preferences?->preferred_origin_id;
            $filters['religion_id']              = $request->filled('religion_id')              ? $request->input('religion_id')              : $preferences?->preferred_religion_id;
            $filters['religiosity_level_id']     = $request->filled('religiosity_level_id')     ? $request->input('religiosity_level_id')     : $preferences?->preferred_religiosity_level_id;
            $filters['country_of_residence_id']  = $request->filled('country_of_residence_id')  ? $request->input('country_of_residence_id')  : $preferences?->preferred_country_id;
            $filters['city_id']                  = $request->filled('city_id')                  ? $request->input('city_id')                  : $preferences?->preferred_city_id;
            $filters['educational_level_id']     = $request->filled('educational_level_id')     ? $request->input('educational_level_id')     : $preferences?->preferred_educational_level_id;
            $filters['specialization_id']        = $request->filled('specialization_id')        ? $request->input('specialization_id')        : $preferences?->preferred_specialization_id;
            $filters['employment_status']        = $request->filled('employment_status')        ? $request->input('employment_status')        : $preferences?->preferred_employment_status;
            $filters['job_title_id']             = $request->filled('job_title_id')             ? $request->input('job_title_id')             : $preferences?->preferred_job_title_id;
            $filters['financial_status_id']      = $request->filled('financial_status_id')      ? $request->input('financial_status_id')      : $preferences?->preferred_financial_status_id;
            $filters['height_id']                = $request->filled('height_id')                ? $request->input('height_id')                : $preferences?->preferred_height_id;
            $filters['weight_id']                = $request->filled('weight_id')                ? $request->input('weight_id')                : $preferences?->preferred_weight_id;
            $filters['marital_status_id']        = $request->filled('marital_status_id')        ? $request->input('marital_status_id')        : $preferences?->preferred_marital_status_id;
            $filters['children']                 = $request->filled('children')                 ? $request->input('children')                 : $preferences?->preferred_children;
            $filters['smoking_status']           = $request->filled('smoking_status')           ? $request->input('smoking_status')           : $preferences?->preferred_smoking_status;
            $filters['drinking_status_id']       = $request->filled('drinking_status_id')       ? $request->input('drinking_status_id')       : $preferences?->preferred_drinking_status_id;
            $filters['sports_activity_id']       = $request->filled('sports_activity_id')       ? $request->input('sports_activity_id')       : $preferences?->preferred_sports_activity_id;
            $filters['social_media_presence_id'] = $request->filled('social_media_presence_id') ? $request->input('social_media_presence_id') : $preferences?->preferred_social_media_presence_id;
            $filters['sleep_habit_id']           = $request->filled('sleep_habit_id')           ? $request->input('sleep_habit_id')           : $preferences?->preferred_sleep_habit_id;
            $filters['marriage_budget_id']       = $request->filled('marriage_budget_id')       ? $request->input('marriage_budget_id')       : $preferences?->preferred_marriage_budget_id;
            $filters['language_id']              = $request->filled('language_id')              ? $request->input('language_id')              : $preferences?->preferred_language_id;
            $filters['zodiac_sign_id']           = $request->filled('zodiac_sign_id')           ? $request->input('zodiac_sign_id')           : $preferences?->preferred_zodiac_sign_id;
            $filters['sector_id']                = $request->filled('sector_id')                ? $request->input('sector_id')                : $preferences?->preferred_sector_id;
            $filters['position_level_id']        = $request->filled('position_level_id')        ? $request->input('position_level_id')        : $preferences?->preferred_position_level_id;
            $filters['housing_id']               = $request->filled('housing_id')               ? $request->input('housing_id')               : $preferences?->preferred_housing_id;
            $filters['car_ownership']            = $request->filled('car_ownership')            ? $request->input('car_ownership')            : $preferences?->preferred_car_ownership;
            $filters['skin_color_id']            = $request->filled('skin_color_id')            ? $request->input('skin_color_id')            : $preferences?->preferred_skin_color_id;
            $filters['hair_color_id']            = $request->filled('hair_color_id')            ? $request->input('hair_color_id')            : $preferences?->preferred_hair_color_id;
            $filters['eye_color_id']             = $request->filled('eye_color_id')             ? $request->input('eye_color_id')             : $preferences?->preferred_eye_color_id;
            $filters['hijab_status']             = $request->filled('hijab_status')             ? $request->input('hijab_status')             : $preferences?->preferred_hijab_status;
            $filters['city_location_id']         = $request->filled('city_location_id')         ? $request->input('city_location_id')         : $preferences?->preferred_city_location_id;
            $filters['area']                     = $request->filled('area')                     ? $request->input('area')                     : $preferences?->preferred_area;

            // Age range
            $ageMin = $request->filled('age_min') ? $request->input('age_min') : $preferences?->preferred_age_min;
            $ageMax = $request->filled('age_max') ? $request->input('age_max') : $preferences?->preferred_age_max;
        }

        // Treat a submitted value of 'any' (case‑insensitive) as no preference,
        // so it is ignored during query construction.
        foreach ($filters as $k => $v) {
            if (is_string($v) && strtolower($v) === 'any') {
                $filters[$k] = null;
            }
        }
        if (is_string($ageMin) && strtolower($ageMin) === 'any') {
            $ageMin = null;
        }
        if (is_string($ageMax) && strtolower($ageMax) === 'any') {
            $ageMax = null;
        }

        $exactQuery = clone $baseQuery;

        if (!is_null($ageMin) && !is_null($ageMax)) {
            $exactQuery->whereBetween('age', [$ageMin, $ageMax]);
        }

        foreach ($filters as $key => $value) {
            if (!is_null($value)) {
                $exactQuery->where($key, $value);
            }
        }

        Log::debug('UserFilterService - Exact Query SQL', ['sql' => $exactQuery->toSql()]);
        Log::debug('UserFilterService - Exact Query Bindings', ['bindings' => $exactQuery->getBindings()]);

        // Apply subscription-based ordering for females
        $exactMatches = $this->applySubscriptionOrdering($exactQuery);

        $nonNullFilters = array_filter($filters, fn($v) => !is_null($v));
        $totalFilters   = count($nonNullFilters);

        $candidateQuery = clone $baseQuery;

        if (!is_null($ageMin) && !is_null($ageMax)) {
            $candidateQuery->whereBetween('age', [$ageMin, $ageMax]);
        }

        // Always apply strict filtering for these keys (if provided).
        $strictKeys = ['country_of_residence_id', 'religion_id'];
        foreach ($strictKeys as $strictKey) {
            if (!empty($filters[$strictKey])) {
                $candidateQuery->where($strictKey, $filters[$strictKey]);
                unset($nonNullFilters[$strictKey]); // Exclude from relaxed filters
                $totalFilters--;
            }
        }

        // Apply relaxed OR-based conditions for remaining filters
        if ($totalFilters > 0) {
            $candidateQuery->where(function ($q) use ($nonNullFilters) {
                foreach ($nonNullFilters as $key => $value) {
                    $q->orWhere($key, $value);
                }
            });
        }

        $candidates = $candidateQuery->get();

        $exactIDs = $exactMatches->pluck('id')->toArray();
        $suggestionPool = collect();

        foreach ($candidates as $candidate) {
            if (in_array($candidate->id, $exactIDs)) {
                continue;
            }

            $matchCount = 0;
            foreach ($nonNullFilters as $key => $value) {
                if ($candidate->{$key} == $value) {
                    $matchCount++;
                }
            }

            $ratio = ($totalFilters > 0) ? ($matchCount / $totalFilters) * 100 : 0;
            if ($ratio >= 50) {
                $candidate->suggestion_ratio = $ratio;
                $suggestionPool->push($candidate);
            }
        }

        $suggestionPool = $suggestionPool->sortByDesc('suggestion_ratio')->values();

        // Apply subscription-based ordering for suggested users as well
        $suggestedUsers = $this->applySubscriptionOrderingToCollection($suggestionPool)->take(10);

        $suggestedPercentage = $suggestionPool->isNotEmpty()
            ? round($suggestionPool->first()->suggestion_ratio, 2)
            : 0;

        return [
            'exact_matches' => FilteredUserResource::collection($exactMatches),
            'suggested_users' => FilteredUserResource::collection($suggestedUsers),
            'suggestion_percentage' => $suggestedPercentage
        ];
    }

    /**
     * Apply subscription-based ordering to a query builder
     * Prioritizes subscribed females first, then non-subscribed females
     */
    private function applySubscriptionOrdering($query)
    {
        // Check if the current user is looking for females
        $currentUserGender = Auth::user()->gender;
        $lookingForFemales = $currentUserGender !== 'female';

        if ($lookingForFemales) {
            // Add subscription information and order by subscription status
            $query->leftJoin('subscriptions', function ($join) {
                $join->on('user_profiles.id', '=', 'subscriptions.user_id')
                    ->where('subscriptions.status', '=', 'active')
                    ->where('subscriptions.end_date', '>', now());
            })
                ->select('user_profiles.*')
                ->selectRaw('CASE WHEN subscriptions.id IS NOT NULL THEN 1 ELSE 0 END as has_active_subscription')
                ->distinct('user_profiles.id') // 👈 يمنع التكرار 100%
                ->orderByDesc('has_active_subscription')
                ->orderBy('user_profiles.created_at', 'desc');
        } else {
            // For non-female seekers, maintain random order
            $query->inRandomOrder();
        }

        return $query->get();
    }

    /**
     * Apply subscription-based ordering to a collection
     * Prioritizes subscribed females first, then non-subscribed females
     */
    private function applySubscriptionOrderingToCollection($collection)
    {
        // Check if the current user is looking for females
        $currentUserGender = Auth::user()->gender;
        $lookingForFemales = $currentUserGender !== 'female';

        if ($lookingForFemales && $collection->isNotEmpty()) {
            // Get user IDs from the collection
            $userIds = $collection->pluck('id')->toArray();

            // Get active subscriptions for these users
            $activeSubscriptions = Subscription::where('status', 'active')
                ->where('end_date', '>', now())
                ->whereIn('user_id', $userIds)
                ->pluck('user_id')
                ->toArray();

            // Sort collection: subscribed users first, then non-subscribed
            return $collection->sortBy(function ($user) use ($activeSubscriptions) {
                return in_array($user->id, $activeSubscriptions) ? 0 : 1;
            })->values();
        }

        // For non-female seekers or empty collection, return as is (shuffled)
        return $collection->shuffle();
    }
}
