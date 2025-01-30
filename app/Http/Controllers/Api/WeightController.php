<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WeightResource;
use App\Models\Weight;
use Illuminate\Http\Request;

class WeightController extends Controller
{
    public function index(Request $request)
    {
        $weights = Weight::all();
        return WeightResource::collection($weights);
    }
}