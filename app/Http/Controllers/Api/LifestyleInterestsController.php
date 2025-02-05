<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\LifestyleInterestsGroupResource;
use App\Models\Hobby;
use App\Models\Pet;
use App\Models\ReligiosityLevel;
use App\Models\SportsActivity;
use App\Models\SmokingTool;
use App\Models\DrinkingStatus;
use Illuminate\Http\Request;

class LifestyleInterestsController extends Controller
{
    /**
     * Display all lifestyle and interests data.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        // Convert the user's gender ('male' or 'female') to the corresponding integer value.
        // For example: male => 1, female => 2.
        $gender = $user->gender === 'male' ? 1 : 2;

        // Retrieve religiosity levels based on the gender
        $religiosityLevels = ReligiosityLevel::where('gender', $gender)->get();
        $hobbies = Hobby::all();
        $pets = Pet::all();
        $sportsActivities = SportsActivity::all();
        $smokingTools = SmokingTool::all();
        $drinkingStatuses = DrinkingStatus::all();

        // Prepare the aggregated data
        $data = [
            'hobbies' => $hobbies,
            'pets' => $pets,
            'sportsActivities' => $sportsActivities,
            'smokingTools' => $smokingTools,
            'drinkingStatuses' => $drinkingStatuses,
            'religiosityLevels' => $religiosityLevels
            
        ];

        // Return using the aggregated resource
        return (new LifestyleInterestsGroupResource((object)$data))
                    ->response()
                    ->setStatusCode(200);
    }
}