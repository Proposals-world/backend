<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function getCitiesByCountry(Request $request, $countryId)
    {
        $cities = City::where('country_id', $countryId)->get();
        return CityResource::collection($cities);
    }
}