<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\GeographicCulturalSocioeconomicGroupResource;
use App\Models\Country;
use App\Models\Religion;
use App\Models\Nationality;
use App\Models\HousingStatus;
use App\Models\FinancialStatus;
use Illuminate\Http\Request;

class GeographicCulturalSocioeconomicController extends Controller
{
    /**
     * Display all geographic, cultural, and socioeconomic data.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Fetch all required data
        $countries = Country::all();
        $religions = Religion::all();
        $nationalities = Nationality::all();
        $housingStatuses = HousingStatus::all();
        $financialStatuses = FinancialStatus::all();

        // Prepare the aggregated data
        $data = [
            'countries' => $countries,
            'religions' => $religions,
            'nationalities' => $nationalities,
            'housingStatuses' => $housingStatuses,
            'financialStatuses' => $financialStatuses,
        ];

        // Return using the aggregated resource
        return (new GeographicCulturalSocioeconomicGroupResource((object)$data))
                    ->response()
                    ->setStatusCode(200);
    }
}