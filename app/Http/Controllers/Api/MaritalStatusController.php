<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MaritalStatusResource;
use App\Models\MaritalStatus;
use Illuminate\Http\Request;

class MaritalStatusController extends Controller
{
    public function index(Request $request)
    {
        $maritalStatuses = MaritalStatus::all();
        return MaritalStatusResource::collection($maritalStatuses);
    }
}