<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\HobbyResource;
use App\Models\Hobby;
use Illuminate\Http\Request;

class HobbyController extends Controller
{
    public function index(Request $request)
    {
        $hobbies = Hobby::all();
        return HobbyResource::collection($hobbies);
    }
}