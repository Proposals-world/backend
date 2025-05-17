<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureProfileIsComplete
{
    /**
     * List of required profile fields.
     *
     * @var array
     */
    protected $requiredFields = [
    'nationality_id',
    'religion_id',
    'country_of_residence_id',
    'city_id',
    'date_of_birth',
    'age',
    'educational_level_id',
];

    /**
     * Handle an incoming request.
     *
     * If any of the required profile fields is empty, redirect to the on-boarding page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // Only proceed if the user is authenticated and has a profile relationship.
        if ($user && $user->profile) {
            $attributes = $user->profile->getAttributes();

            foreach ($this->requiredFields as $field) {
                if (!isset($attributes[$field]) || is_null($attributes[$field]) || $attributes[$field] === '') {
                    return redirect()->route('onboarding');
                }
            }
        }

        return $next($request);
    }
}
