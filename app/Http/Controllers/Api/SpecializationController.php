<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SpecializationResource;
use App\Models\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    public function index(Request $request)
    {
        $specializations = Specialization::all();
        return SpecializationResource::collection($specializations);
    }
}
