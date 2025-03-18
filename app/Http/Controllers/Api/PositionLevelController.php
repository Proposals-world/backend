<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PositionLevelResource;
use App\Models\PositionLevel;
use Illuminate\Http\Request;

class PositionLevelController extends Controller
{
    public function index(Request $request)
    {
        $positionLevels = PositionLevel::all();
        return PositionLevelResource::collection($positionLevels);
    }
}
