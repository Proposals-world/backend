<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserFeedbackRequest;
use App\Http\Resources\MatchResource;
use Illuminate\Http\Request;
use App\Models\UserFeedback;
use App\Http\Resources\UserFeedbackResource;
use App\Models\UserMatch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserDashboardController extends Controller
{
    public function index()
    {
        $matches = UserMatch::with(['user1', 'user2'])
            ->where(function ($query) {
                $query->where('user1_id', Auth::id())
                    ->orWhere('user2_id', Auth::id());
            })->where('contact_exchanged', 1)
            ->whereDoesntHave('feedback', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->latest()
            ->get();
        $transformed = MatchResource::collection($matches)->resolve(); // convert to array

        // Retrieve the application's current locale (language)
        $lang = app()->getLocale();
        // dd(UserFeedback::all());
        // Pass the matches and the locale to the view
        return view('user.dashboard', [
            'matches' => $transformed,
            'appLocale' => $lang
        ]);
    }
}
