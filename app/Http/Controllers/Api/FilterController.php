<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FilteredUserResource;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilterController extends Controller
{
    public function filterUsers(Request $request)
    {
        $query = UserProfile::with(['user', 'user.photos']);
        $query->whereHas('user', function ($query) use ($request) {
            $query->where('gender', '!=', Auth::user()->gender);
        });
        //Nationality
        if ($request->filled("nationality_id"))
            $query->where('nationality_id', $request->nationality_id);
        //Origins
        if ($request->filled("origin_id"))
            $query->where('origin_id', $request->origin_id);
        //Religion ------- there is a bug return this as null
        if ($request->filled("religion_id"))
            $query->where('religion_id', $request->religion_id);
        //Religiosity Level
        if ($request->filled("religiosity_level_id"))
            $query->where('religiosity_level_id', $request->religiosity_level_id);
        //Country Of Residence
        if ($request->filled("country_of_residence_id"))
            $query->where('country_of_residence_id', $request->country_of_residence_id);
        //City
        if ($request->filled("city_id"))
            $query->where('city_id', $request->city_id);
        //Age
        if ($request->filled('age_min') && $request->filled('age_max')) {
            $query->whereBetween('age', [$request->age_min, $request->age_max]);
        }
        //Educational Level
        if ($request->filled("educational_level_id"))
            $query->where('educational_level_id', $request->educational_level_id);
        //Specialization
        if ($request->filled("specialization_id"))
            $query->where('specialization_id', $request->specialization_id);
        //Employment Status --> boolean
        if ($request->filled("employment_status"))
            $query->where('employment_status', $request->employment_status);
        //Job Title
        if ($request->filled("job_title_id"))
            $query->where('job_title_id', $request->job_title_id);
        //Financial Status
        if ($request->filled("financial_status_id"))
            $query->where('financial_status_id', $request->financial_status_id);
        // Height
        if ($request->filled('height_id')) {
            $query->where('height_id', $request->height_id);
        }

        // Weight
        if ($request->filled('weight_id')) {
            $query->where('weight_id', $request->weight_id);
        }

        // Marital Status
        if ($request->filled('marital_status_id')) {
            $query->where('marital_status_id', $request->marital_status_id);
        }

        // Children and Future Plans
        if ($request->filled('children')) {
            $query->where('children', $request->children);
        }


        // Smoking --> boolean  --- add tools -- fix error getting null
        if ($request->filled('smoking_status')) {
            $query->where('smoking_status', $request->smoking_status);
        }
        // Drinking
        if ($request->filled('drinking_status_id')) {
            $query->where('drinking_status_id', $request->drinking_status_id);
        }
        // Sports Habits
        if ($request->filled('sports_activity_id')) {
            $query->where('sports_activity_id', $request->sports_activity_id);
        }
        // Social Media Presence
        if ($request->filled('social_media_presence_id')) {
            $query->where('social_media_presence_id', $request->social_media_presence_id);
        }

        // Sleep Habit
        if ($request->filled('sleep_habit_id')) {
            $query->where('sleep_habit_id', $request->sleep_habit_id);
        }

        // Marriage Budget
        if ($request->filled('marriage_budget_id')) {
            $query->where('marriage_budget_id', $request->marriage_budget_id);
        }

        $users = $query->get();
        return response()->json([
            'message' => "success",
            'users' => FilteredUserResource::collection($users)
        ], 200);
    }
}
