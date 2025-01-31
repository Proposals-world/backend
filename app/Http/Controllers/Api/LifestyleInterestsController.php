<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\LifestyleInterestsGroupResource;
use App\Models\Hobby;
use App\Models\Pet;
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
        // Fetch all required data
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
        ];

        // Return using the aggregated resource
        return (new LifestyleInterestsGroupResource((object)$data))
                    ->response()
                    ->setStatusCode(200);
    }
}