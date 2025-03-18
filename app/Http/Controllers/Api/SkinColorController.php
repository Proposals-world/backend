<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SkinColorResource;
use App\Models\SkinColor;
use Illuminate\Http\Request;

class SkinColorController extends Controller
{
    public function index(Request $request)
    {
        $skinColors = SkinColor::all();
        return SkinColorResource::collection($skinColors);
    }
}
