<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

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
            return redirect()->route('user.dashboard');
        } else {
            // If the role isn't recognized, log out and redirect to the login page.
            Auth::logout();
            return redirect()->route('login');
        }
    }
}
