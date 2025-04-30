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

        // Only apply to females
        if (strtolower($user->gender) === 'female') {
            $guardianVerification = GuardianOtp::where('user_id', $user->id)
                ->where('verified', 1) // must be integer if stored as 1/0
                ->latest('id')
                ->first();

            $isVerificationPage = $request->routeIs('verify.guardian.otp');

            // ❌ If NOT verified and trying to access other pages → redirect to verification page
            if (!$guardianVerification && !$isVerificationPage) {
                return redirect()->route('verify.guardian.otp');
            }

            // ❌ If already verified and trying to access the verification page → redirect to dashboard
            if ($guardianVerification && $isVerificationPage) {
                return redirect()->route('user.dashboard');
            }
        }

        return $next($request);
    }
}
