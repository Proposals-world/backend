<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OriginResource;
use App\Models\Origin;
use Illuminate\Http\Request;

class OriginController extends Controller
{
    public function index(Request $request)
    {
        $origins = Origin::all();
        return OriginResource::collection($origins);
    }
}
