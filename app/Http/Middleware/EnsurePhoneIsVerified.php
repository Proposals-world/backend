<?php

namespace App\Http\Middleware;

use App\Models\UserPhoneNumberOtp;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsurePhoneIsVerified
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Check if user has a verified phone
        $isVerified = UserPhoneNumberOtp::where('user_id', $user->id)
            ->where('verified', 1)
            ->exists();

        $isVerificationPage = $request->routeIs('user.phone.index');

        if ($isVerified && $isVerificationPage) {
            // If already verified, don't let them access verification page
            return redirect()->route('user.dashboard');
        }

        if (!$isVerified && !$isVerificationPage) {
            // If not verified, don't let them access anything except verification page
            return redirect()->route('user.phone.index');
        }

        return $next($request);
    }
}
