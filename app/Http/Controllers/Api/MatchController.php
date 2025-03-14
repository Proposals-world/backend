<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MatchResource;
use App\Models\UserMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchController extends Controller
{
    public function getMatches(Request $request)
    {
        if (!Auth::user()) {
            return response()->json(["failed" => "Unauthorized"], 401);
        };
        $matches = UserMatch::with(['user1', 'user2'])->where('user1_id', Auth::user()->id)->orWhere('user2_id', Auth::user()->id)->get();
        return MatchResource::collection($matches);
    }
}
