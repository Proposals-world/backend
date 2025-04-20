<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // If user is not logged in, just continue (or redirect to login optionally)
        if (!$user) {
            return redirect()->route('login');
        }
        // dd('before');
        // If user has no profile and current route is not the onboarding page, redirect to onboarding
        if (!$user->profile && !$request->is('user/on-boarding')) {
            return redirect()->route('onboarding');
        }
        // dd('after');
        // If user's status is not active, logout and redirect to login
        if ($user->status !== 'active') {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'email' => 'Your account is not active. Please wait for admin review of your profile or contact support for assistance.',
            ]);
        }


        return $next($request);
    }
}
