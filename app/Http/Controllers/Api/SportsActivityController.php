<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SportsActivityResource;
use App\Models\SportsActivity;
use Illuminate\Http\Request;

class SportsActivityController extends Controller
{
    public function index(Request $request)
    {
        $sportsActivities = SportsActivity::all();
        return SportsActivityResource::collection($sportsActivities);
    }
}