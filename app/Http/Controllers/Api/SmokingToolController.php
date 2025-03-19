<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SmokingToolResource;
use App\Models\SmokingTool;
use Illuminate\Http\Request;

class SmokingToolController extends Controller
{
    public function index(Request $request)
    {
        $smokingTools = SmokingTool::all();
        return SmokingToolResource::collection($smokingTools);
    }
}
