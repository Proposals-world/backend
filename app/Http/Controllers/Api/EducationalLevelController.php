<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\EducationalLevelResource;
use App\Models\EducationalLevel;
use Illuminate\Http\Request;

class EducationalLevelController extends Controller
{
    public function index(Request $request)
    {
        $educationalLevels = EducationalLevel::all();
        return EducationalLevelResource::collection($educationalLevels);
    }
}