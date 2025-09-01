<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    protected $requiredFields = [
        'nationality_id',
        'religion_id',
        'country_of_residence_id',
        'city_id',
        'date_of_birth',
        'age',
        'educational_level_id',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (!$user->profile || $this->isProfileIncomplete($user->profile)) {
            if (!$request->is('user/on-boarding')) {
                return redirect()->route('onboarding');
            }
        }
        if ($user->status === 'suspended') {
            if (!$request->routeIs('user.support')) {  // Use route name here
                return redirect()->route('user.support');
            }
        }
        if ($user->status !== 'active' && $user->status != "suspended") {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'email' => __('Your account is not active. Please wait for admin review or contact support.'),
            ]);
        }

        return $next($request);
    }

    protected function isProfileIncomplete($profile)
    {
        foreach ($this->requiredFields as $field) {
            if (empty($profile->$field)) {
                return true;
            }
        }
        return false;
    }
}
