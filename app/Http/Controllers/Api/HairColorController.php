<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\HairColorResource;
use App\Models\HairColor;
use Illuminate\Http\Request;

class HairColorController extends Controller
{
    public function index(Request $request)
    {
        $hairColors = HairColor::all();
        return HairColorResource::collection($hairColors);
    }
}