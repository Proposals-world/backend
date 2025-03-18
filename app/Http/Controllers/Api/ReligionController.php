<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReligionResource;
use App\Models\Religion;
use Illuminate\Http\Request;

class ReligionController extends Controller
{
    public function index(Request $request)
    {
        $religions = Religion::all();
        return ReligionResource::collection($religions);
    }
}
