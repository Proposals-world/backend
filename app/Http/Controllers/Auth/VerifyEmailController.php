<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\UserPreference;               //  ← add this

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified,
     * ensure an empty profile, and attach an all-NULL preferences row.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $user = $request->user();

        // 1️⃣  Already verified?  Just get them to the dashboard.
        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', false) . '?verified=1');
        }

        // 2️⃣  Mark verified & fire event.
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        // 3️⃣  Guarantee a profile row.
        if (!$user->profile) {
            $user->profile()->create([]);
        }

        // 4️⃣  Guarantee a preferences row with ALL columns = null.
        if (!$user->preference) {                              // relation is preference() on User model
            $user->preference()->create(
                array_fill_keys(
                    (new UserPreference)->getFillable(),       // every fillable column
                    null                                       // value: null
                ) + ['user_id' => $user->id]                   // user_id must be set
            );
        }

        return redirect()->intended(route('dashboard', false) . '?verified=1');
    }
}
