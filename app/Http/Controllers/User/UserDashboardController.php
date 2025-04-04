<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\MatchResource;
use Illuminate\Http\Request;
use App\Models\UserFeedback;
use App\Http\Resources\UserFeedbackResource;
use App\Models\UserMatch;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $matches = UserMatch::with(['user1', 'user2'])
            ->where('user1_id', Auth::id())
            ->orWhere('user2_id', Auth::id())
            ->latest()
            ->get();

        $transformed = MatchResource::collection($matches)->resolve(); // convert to array
        return view('user.dashboard', ['matches' => $transformed]);
    }
}
