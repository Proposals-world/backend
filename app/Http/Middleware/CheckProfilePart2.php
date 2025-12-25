<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckProfilePart2
{
    /**
     * List of profile fields that should be complete.
     * If ALL of these fields are filled, redirect to dashboard.
     *
     * @var array
     */
    protected $requiredFields = [
        'educational_level_id',
        'employment_status',
    ];

    /**
     * Handle an incoming request.
     *
     * If ALL of the required profile fields are complete, redirect to dashboard.
     * Otherwise, allow access to the onboarding process.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // Only check if user is authenticated and has a profile
        if ($user && $user->profile) {
            $attributes = $user->profile->getAttributes();

            $allFieldsComplete = true;

            foreach ($this->requiredFields as $field) {
                if (!isset($attributes[$field]) || is_null($attributes[$field]) || $attributes[$field] === '') {
                    $allFieldsComplete = false;
                    break;
                }
            }

            // If ALL fields are complete, redirect to dashboard
            if ($allFieldsComplete) {
                // Optional: Add a flash message
                // session()->flash('info', 'Your profile is already complete.');
                return redirect()->route('dashboard');
            }
        }

        return $next($request);
    }
}
