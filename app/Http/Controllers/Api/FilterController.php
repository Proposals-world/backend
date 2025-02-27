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
        // Get the logged-in user's preferences
        $preferences = UserPreference::where('user_id', Auth::id())->first();
        $isFromFilter = $request->input('isFilter', false);
        $query = UserProfile::with(['user', 'user.photos']);
        $query->whereHas('user', function ($query) use ($request) {
            $query->where('gender', '!=', Auth::user()->gender);
        });
        // Filter out liked and disliked users
        $likedUsers = Like::where('user_id', Auth::id())->pluck('liked_user_id');
        $dislikedUsers = Dislike::where('user_id', Auth::id())->pluck('disliked_user_id');

        $query->whereNotIn('id', $likedUsers);
        $query->whereNotIn('id', $dislikedUsers);

        // Gender preference (excluding users of the same gender as the logged-in user)
        $query->whereHas('user', function ($query) use ($request) {
            $query->where('gender', '!=', Auth::user()->gender);
        });
        // Filter based on user's preferences if available
        if ($preferences && !$isFromFilter) {
            // dd("from pref");
            // Nationality
            if ($preferences->preferred_nationality_id) {
                $query->where('nationality_id', $preferences->preferred_nationality_id);
            }

            // Origins
            if ($preferences->preferred_origin_id) {
                $query->where('origin_id', $preferences->preferred_origin_id);
            }

            // Country of residence
            if ($preferences->preferred_country_id) {
                $query->where('country_of_residence_id', $preferences->preferred_country_id);
            }

            // City
            if ($preferences->preferred_city_id) {
                $query->where('city_id', $preferences->preferred_city_id);
            }

            // Age range
            if ($preferences->preferred_age_min && $preferences->preferred_age_max) {
                $query->whereBetween('age', [$preferences->preferred_age_min, $preferences->preferred_age_max]);
            }

            // Educational level
            if ($preferences->preferred_educational_level_id) {
                $query->where('educational_level_id', $preferences->preferred_educational_level_id);
            }

            // Specialization
            if ($preferences->preferred_specialization_id) {
                $query->where('specialization_id', $preferences->preferred_specialization_id);
            }

            // Employment status
            if ($preferences->preferred_employment_status !== null) {
                $query->where('employment_status', $preferences->preferred_employment_status);
            }

            // Job title
            if ($preferences->preferred_job_title_id) {
                $query->where('job_title_id', $preferences->preferred_job_title_id);
            }

            // Financial status
            if ($preferences->preferred_financial_status_id) {
                $query->where('financial_status_id', $preferences->preferred_financial_status_id);
            }

            // Height
            if ($preferences->preferred_height_id) {
                $query->where('height_id', $preferences->preferred_height_id);
            }

            // Weight
            if ($preferences->preferred_weight_id) {
                $query->where('weight_id', $preferences->preferred_weight_id);
            }

            // Marital status
            if ($preferences->preferred_marital_status_id) {
                $query->where('marital_status_id', $preferences->preferred_marital_status_id);
            }

            // Smoking status
            if ($preferences->preferred_smoking_status !== null) {
                $query->where('smoking_status', $preferences->preferred_smoking_status);
            }

            // Drinking status
            if ($preferences->preferred_drinking_status_id) {
                $query->where('drinking_status_id', $preferences->preferred_drinking_status_id);
            }

            // Sports activity
            if ($preferences->preferred_sports_activity_id) {
                $query->where('sports_activity_id', $preferences->preferred_sports_activity_id);
            }

            // Social media presence
            if ($preferences->preferred_social_media_presence_id) {
                $query->where('social_media_presence_id', $preferences->preferred_social_media_presence_id);
            }

            // Religiosity level
            if ($preferences->preferred_religiosity_level_id) {
                $query->where('religiosity_level_id', $preferences->preferred_religiosity_level_id);
            }

            // Sleep habit
            if ($preferences->preferred_sleep_habit_id) {
                $query->where('sleep_habit_id', $preferences->preferred_sleep_habit_id);
            }

            // Marriage budget
            if ($preferences->preferred_marriage_budget_id) {
                $query->where('marriage_budget_id', $preferences->preferred_marriage_budget_id);
            }
        } else {
            // Handle additional request filters (if any)
            // dd("from filter");
            if ($request->filled('nationality_id')) {
                $query->where('nationality_id', $request->nationality_id);
            }
            if ($request->filled('origin_id')) {
                $query->where('origin_id', $request->origin_id);
            }
            if ($request->filled('religion_id')) {
                $query->where('religion_id', $request->religion_id);
            }
            if ($request->filled('religiosity_level_id')) {
                $query->where('religiosity_level_id', $request->religiosity_level_id);
            }
            if ($request->filled('country_of_residence_id')) {
                $query->where('country_of_residence_id', $request->country_of_residence_id);
            }
            if ($request->filled('city_id')) {
                $query->where('city_id', $request->city_id);
            }
            if ($request->filled('age_min') && $request->filled('age_max')) {
                $query->whereBetween('age', [$request->age_min, $request->age_max]);
            }
            if ($request->filled('educational_level_id')) {
                $query->where('educational_level_id', $request->educational_level_id);
            }
            if ($request->filled('specialization_id')) {
                $query->where('specialization_id', $request->specialization_id);
            }
            if ($request->filled('employment_status')) {
                $query->where('employment_status', $request->employment_status);
            }
            if ($request->filled('job_title_id')) {
                $query->where('job_title_id', $request->job_title_id);
            }
            if ($request->filled('financial_status_id')) {
                $query->where('financial_status_id', $request->financial_status_id);
            }
            if ($request->filled('height_id')) {
                $query->where('height_id', $request->height_id);
            }
            if ($request->filled('weight_id')) {
                $query->where('weight_id', $request->weight_id);
            }
            if ($request->filled('marital_status_id')) {
                $query->where('marital_status_id', $request->marital_status_id);
            }
            if ($request->filled('children')) {
                $query->where('children', $request->children);
            }
            if ($request->filled('smoking_status')) {
                $query->where('smoking_status', $request->smoking_status);
            }
            if ($request->filled('drinking_status_id')) {
                $query->where('drinking_status_id', $request->drinking_status_id);
            }
            if ($request->filled('sports_activity_id')) {
                $query->where('sports_activity_id', $request->sports_activity_id);
            }
            if ($request->filled('social_media_presence_id')) {
                $query->where('social_media_presence_id', $request->social_media_presence_id);
            }
            if ($request->filled('sleep_habit_id')) {
                $query->where('sleep_habit_id', $request->sleep_habit_id);
            }
            if ($request->filled('marriage_budget_id')) {
                $query->where('marriage_budget_id', $request->marriage_budget_id);
            }
        }




        // dd("filter");
        // Execute the query and return filtered users
        $users = $query->get();

        return response()->json([
            'message' => 'success',
            'users' => FilteredUserResource::collection($users),
        ], 200);
    }
}
