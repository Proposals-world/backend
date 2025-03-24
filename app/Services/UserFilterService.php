<?php

namespace App\Services;

use App\Http\Resources\FilteredUserResource;
use App\Models\Dislike;
use App\Models\Like;
use App\Models\UserProfile;
use App\Models\UserPreference;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserFilterService
{
    public function filter(Request $request)
    {
        $preferences = UserPreference::where('user_id', Auth::id())->first();
        $isFromFilter = $request->input('isFilter', false);
        $hasUserProfile = UserProfile::where('id', Auth::id())->exists();

        $query = UserProfile::with(['user', 'user.photos', 'user.pets', 'smokingTools'])
            ->whereHas('user', function ($query) {
                $query->where('gender', '!=', Auth::user()->gender)
                    ->where('role_id', '!=', 1);
            });

        $likedUsers = Like::where('user_id', Auth::id())->pluck('liked_user_id');
        $dislikedUsers = Dislike::where('user_id', Auth::id())->pluck('disliked_user_id');

        $query->whereNotIn('id', $likedUsers)
            ->whereNotIn('id', $dislikedUsers);

        $filters = [];
        $preferencesFilters = [];

        if ($preferences && !$isFromFilter) {
            $preferencesFilters = [
                'nationality_id' => $preferences->preferred_nationality_id,
                'origin_id' => $preferences->preferred_origin_id,
                'religion_id' => $preferences->preferred_religion_id,
                'religiosity_level_id' => $preferences->preferred_religiosity_level_id,
                'country_of_residence_id' => $preferences->preferred_country_id,
                'city_id' => $preferences->preferred_city_id,
                'educational_level_id' => $preferences->preferred_educational_level_id,
                'specialization_id' => $preferences->preferred_specialization_id,
                'employment_status' => $preferences->preferred_employment_status,
                'job_title_id' => $preferences->preferred_job_title_id,
                'financial_status_id' => $preferences->preferred_financial_status_id,
                'height_id' => $preferences->preferred_height_id,
                'weight_id' => $preferences->preferred_weight_id,
                'marital_status_id' => $preferences->preferred_marital_status_id,
                'smoking_status' => $preferences->preferred_smoking_status,
                'drinking_status_id' => $preferences->preferred_drinking_status_id,
                'sports_activity_id' => $preferences->preferred_sports_activity_id,
                'social_media_presence_id' => $preferences->preferred_social_media_presence_id,
                'sleep_habit_id' => $preferences->preferred_sleep_habit_id,
                'language_id' => $preferences->preferred_language_id,
                'marriage_budget_id' => $preferences->preferred_marriage_budget_id
            ];

            if (!is_null($preferences->preferred_age_min) && !is_null($preferences->preferred_age_max)) {
                $preferencesFilters['age'] = [$preferences->preferred_age_min, $preferences->preferred_age_max];
            }
        }

        $filters = array_merge($preferencesFilters, [
            'nationality_id' => $request->nationality_id,
            'origin_id' => $request->origin_id,
            'religion_id' => $request->religion_id,
            'religiosity_level_id' => $request->religiosity_level_id,
            'country_of_residence_id' => $request->country_of_residence_id,
            'city_id' => $request->city_id,
            'educational_level_id' => $request->educational_level_id,
            'specialization_id' => $request->specialization_id,
            'employment_status' => $request->employment_status,
            'job_title_id' => $request->job_title_id,
            'financial_status_id' => $request->financial_status_id,
            'height_id' => $request->height_id,
            'weight_id' => $request->weight_id,
            'marital_status_id' => $request->marital_status_id,
            'children' => $request->children,
            'smoking_status' => $request->smoking_status,
            'drinking_status_id' => $request->drinking_status_id,
            'sports_activity_id' => $request->sports_activity_id,
            'social_media_presence_id' => $request->social_media_presence_id,
            'sleep_habit_id' => $request->sleep_habit_id,
            'marriage_budget_id' => $request->marriage_budget_id,
            'language_id' => $request->language_id
        ]);

        if ($request->has('age_min') && $request->has('age_max')) {
            $query->whereBetween('age', [$request->age_min, $request->age_max]);
        }

        foreach ($filters as $key => $value) {
            if (!is_null($value)) {
                $query->where($key, $value);
            }
        }

        $exactMatches = $query->get();
        $suggestedUsers = collect();
        $suggestedPercentage = 100;

        if (!$hasUserProfile && !$isFromFilter) {
            $suggestedUsers = $exactMatches;
            $exactMatches = collect();
        } else {
            $suggestedQuery = clone $query;
            $exactMatchIds = $exactMatches->pluck('id')->toArray();

            $totalFilters = count(array_filter($filters, fn($value) => !is_null($value)));
            $relaxationLevels = [90, 80, 70, 60];

            foreach ($relaxationLevels as $level) {
                if (!$suggestedUsers->isEmpty()) break;

                $remainingFiltersCount = ceil($totalFilters * ($level / 100));
                $activeFilters = array_filter($filters, fn($value) => !is_null($value));
                $selectedFilters = array_slice($activeFilters, 0, $remainingFiltersCount, true);

                $tempQuery = clone $suggestedQuery;

                if ($request->has('age_min') && $request->has('age_max')) {
                    $tempQuery->whereBetween('age', [$request->age_min, $request->age_max]);
                }

                foreach ($selectedFilters as $key => $value) {
                    $tempQuery->where($key, $value);
                }

                $tempQuery->whereNotIn('id', $exactMatchIds);
                $suggestedUsers = $tempQuery->get();

                if (!$suggestedUsers->isEmpty()) {
                    $suggestedPercentage = $level;
                    break;
                }
            }

            if ($suggestedUsers->isEmpty()) {
                $suggestedUsers = UserProfile::with(['user', 'user.photos', 'user.pets', 'smokingTools'])
                    ->whereHas('user', function ($query) {
                        $query->where('gender', '!=', Auth::user()->gender)
                            ->where('role_id', '!=', 1);
                    })
                    ->whereNotIn('id', array_merge($likedUsers->toArray(), $dislikedUsers->toArray(), $exactMatchIds))
                    ->get();
                $suggestedPercentage = 0;
            }
        }

        return [
            'exact_matches' => FilteredUserResource::collection($exactMatches),
            'suggested_users' => FilteredUserResource::collection($suggestedUsers),
            'suggestion_percentage' => $suggestedPercentage
        ];
    }
}
