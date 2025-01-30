<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HeightResource;
use App\Models\Height;
use Illuminate\Http\Request;

class HeightController extends Controller
{
    public function index(Request $request)
    {
        $heights = Height::all();
        return HeightResource::collection($heights);
    }
}