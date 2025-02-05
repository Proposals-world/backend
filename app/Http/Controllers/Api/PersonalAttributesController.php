<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PersonalAttributesGroupResource;
use App\Models\HairColor;
use App\Models\Height;
use App\Models\SleepHabit;
use App\Models\Weight;
use App\Models\Origin;
use App\Models\MaritalStatus;
use App\Models\SkinColor;
use App\Models\ZodiacSign;
use Illuminate\Http\Request;

class PersonalAttributesController extends Controller
{
    /**
     * Display all personal attributes.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Fetch all required data
        $hairColors = HairColor::all();
        $heights = Height::all();
        $weights = Weight::all();
        $origins = Origin::all();
        $maritalStatuses = MaritalStatus::all();
        $skinColors = SkinColor::all();
        $zodiacSigns = ZodiacSign::all();
        $sleepHabits = SleepHabit::all();

        // Prepare the aggregated data
        $data = [
            'hairColors' => $hairColors,
            'heights' => $heights,
            'weights' => $weights,
            'origins' => $origins,
            'maritalStatuses' => $maritalStatuses,
            'skinColors' => $skinColors,
            'zodiacSigns' => $zodiacSigns,
            'sleepHabits' => $sleepHabits,
        ];

        // Return using the aggregated resource
        return (new PersonalAttributesGroupResource((object)$data))
                    ->response()
                    ->setStatusCode(200);
    }
}