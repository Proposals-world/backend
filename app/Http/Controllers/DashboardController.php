<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreUserFeedbackRequest;
use App\Http\Resources\UserFeedbackResource;
use App\Models\UserFeedback;

class DashboardController extends Controller
{


    /**
     * Redirect users based on their role.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(): RedirectResponse
    {
        $user = auth()->user();

        if ($user->role_id == 1) {

            return redirect()->route('admin.dashboard');
        } elseif ($user->role_id == 2) {
            // Fetch and transform feedbacks using resource
            $feedbacks = UserFeedback::with(['user', 'match'])
                ->where('user_id', Auth::id())
                ->latest()
                ->get();

            $transformedFeedback = UserFeedbackResource::collection($feedbacks)->resolve(); // resolve to array

            return redirect()->route('user.dashboard')->with('feedbacks', $transformedFeedback);
        } else {
            // If the role isn't recognized, log out and redirect to the login page.
            Auth::logout();
            return redirect()->route('login');
        }
    }
}
