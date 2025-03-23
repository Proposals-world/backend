<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfessionalEducationalGroupResource;

use App\Models\MarriageBudget;
use App\Models\Specialization;
use App\Models\PositionLevel;
use App\Models\EducationalLevel;
use Illuminate\Http\Request;

class ProfessionalEducationalController extends Controller
{
    /**
     * Display all professional and educational data.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Fetch all required data
        $specializations = Specialization::all();
        $positionLevels = PositionLevel::all();
        $educationalLevels = EducationalLevel::all();
        $marriageBudget = MarriageBudget::all();
        // Prepare the aggregated data
        $data = [
            'specializations' => $specializations,
            'positionLevels' => $positionLevels,
            'educationalLevels' => $educationalLevels,
            'marriageBudget' => $marriageBudget,
        ];

        // Return using the aggregated resource
        return (new ProfessionalEducationalGroupResource((object)$data))
            ->response()
            ->setStatusCode(200);
    }
}
