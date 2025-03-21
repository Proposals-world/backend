<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FilteredUserResource;
use App\Models\Dislike;
use App\Models\Like;
use App\Models\UserProfile;
use App\Models\UserPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilterController extends Controller
{
    public function filterUsers(Request $request)
    {
        // Get user preferences
        $preferences = UserPreference::where('user_id', Auth::id())->first();
        $isFromFilter = $request->input('isFilter', false);

        // Start query with base conditions
        $query = UserProfile::with(['user', 'user.photos', 'user.pets', 'smokingTools'])
            ->whereHas('user', function ($query) {
                $query->where('gender', '!=', Auth::user()->gender)
                    ->where('role_id', '!=', 1);
            });

        // Exclude liked & disliked users
        $likedUsers = Like::where('user_id', Auth::id())->pluck('liked_user_id');
        $dislikedUsers = Dislike::where('user_id', Auth::id())->pluck('disliked_user_id');

        $query->whereNotIn('id', $likedUsers)
            ->whereNotIn('id', $dislikedUsers);

        // **Define Filters Based on Preferences or Request**
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

        // Merge preferences and request filters
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

        // **Apply Filters Initially**
        foreach ($filters as $key => $value) {
            if (!is_null($value)) {
                if ($key === 'age') {
                    $query->whereBetween('age', $value);
                } else {
                    $query->where($key, $value);
                }
            }
        }

        // **Get exact matches first**
        $exactMatches = $query->get();

        // **Prepare a suggestion query (excluding exact matches)**
        $suggestedQuery = clone $query;
        $suggestedUsers = collect();
        $suggestedPercentage = 100;

        $exactMatchIds = $exactMatches->pluck('id')->toArray();

        $totalFilters = count(array_filter($filters, fn($value) => !is_null($value))); // Count active filters

        // **Progressive filter relaxation logic**
        $relaxationLevels = [90, 80, 70, 60];

        foreach ($relaxationLevels as $level) {
            if (!$suggestedUsers->isEmpty()) {
                break; // Stop if we already have suggestions
            }

            $remainingFiltersCount = ceil($totalFilters * ($level / 100)); // How many filters to retain

            // Randomly select filters to keep
            $activeFilters = array_filter($filters, fn($value) => !is_null($value));
            $selectedFilters = array_slice($activeFilters, 0, $remainingFiltersCount, true);

            $tempQuery = clone $suggestedQuery;

            foreach ($selectedFilters as $key => $value) {
                if ($key === 'age') {
                    $tempQuery->whereBetween('age', $value);
                } else {
                    $tempQuery->where($key, $value);
                }
            }

            // Exclude exact matches from suggestions
            $tempQuery->whereNotIn('id', $exactMatchIds);

            $suggestedUsers = $tempQuery->get();

            if (!$suggestedUsers->isEmpty()) {
                $suggestedPercentage = $level;
                break; // Stop once we have suggestions
            }
        }

        // **Final fallback: If no suggestions, return users filtered only by gender & role**
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

        // **Return response with both exact matches & suggestions with percentage message**
        return response()->json([
            'message' => 'success',
            'exact_matches' => FilteredUserResource::collection($exactMatches),
            'suggested_users' => FilteredUserResource::collection($suggestedUsers),
            'suggestion_percentage' => $suggestedPercentage
        ], 200);
    }
}
