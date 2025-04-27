<?php

namespace App\Http\Middleware;

use App\Models\GuardianOtp;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureGuardianContactIsVerified
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // 👇 Only apply for females
        if (strtolower($user->gender) === 'female') {

            $guardianVerification = GuardianOtp::where('user_id', $user->id)
                ->where('verified', true)
                ->first();

            if (!$guardianVerification) {
                return redirect()->route('verify.guardian.otp');
            }
        }

        return $next($request);
    }
}
