<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified and create an empty profile if needed.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $user = $request->user();

        // If the email has already been verified, simply redirect.
        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', false) . '?verified=1');
        }

        // Mark the email as verified and fire the Verified event.
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        // If the user does not have a profile, create an empty profile.
        if (!$user->profile) {
            $user->profile()->create([]);
        }

        return redirect()->intended(route('dashboard', false) . '?verified=1');
    }
}