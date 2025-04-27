<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfProfileComplete
{
    /**
     * List of required profile fields.
     *
     * @var array
     */
    protected $requiredFields = [
        'nationality_id',
        // 'origin_id',
        'religion_id',
        'country_of_residence_id',
        'city_id',
        // 'city_location_id',
        // 'area',
        'date_of_birth',
        'age',
        'zodiac_sign_id',
        'educational_level_id',
        // 'specialization_id',
    ];

    /**
     * Handle an incoming request.
     *
     * If all the required profile fields are filled, then the profile is complete
     * and the user should not be allowed to access the on-boarding page. Redirect to the dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && $user->profile) {
            $attributes = $user->profile->getAttributes();
            $isComplete = true;
            foreach ($this->requiredFields as $field) {
                if (!isset($attributes[$field]) || is_null($attributes[$field]) || $attributes[$field] === '') {
                    $isComplete = false;
                    break;
                }
            }
            if ($isComplete) {
                // If the profile is complete, redirect away from on-boarding (e.g., to the dashboard).
                return redirect()->route('user.dashboard');
            }
        }

        return $next($request);
    }
}
