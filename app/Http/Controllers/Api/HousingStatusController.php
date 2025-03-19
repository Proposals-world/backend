<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HousingStatusResource;
use App\Models\HousingStatus;
use Illuminate\Http\Request;

class HousingStatusController extends Controller
{
    public function index(Request $request)
    {
        $housingStatuses = HousingStatus::all();
        return HousingStatusResource::collection($housingStatuses);
    }
}
