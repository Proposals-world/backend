<?php

namespace App\Http\Controllers\User;

use App\Services\User\OnboardingService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FindMatchController extends Controller
{
    protected $onboardingService;

    public function __construct(OnboardingService $onboardingService)
    {
        $this->onboardingService = $onboardingService;
    }

    public function index(Request $request)
    {
        $data = $this->onboardingService->getOnboardingData();

        $user = auth()->user();
        $filledPreferenceCount = 0;

        if ($user->preference) {
            $prefs = collect($user->preference->toArray());

            // Exclude system fields
            $filtered = $prefs->except(['id', 'user_id', 'created_at', 'updated_at']);

            // Remove age fields temporarily
            $filtered->forget(['preferred_age_min', 'preferred_age_max']);

            // Count all other non-empty fields
            $filledPreferenceCount = $filtered->filter(function ($value) {
                return !is_null($value) && $value !== '';
            })->count();

            // Now handle age fields as one unit
            $ageMin = $user->preference->preferred_age_min;
            $ageMax = $user->preference->preferred_age_max;

            if ($ageMin && $ageMax && $ageMin > 18 && $ageMax < 65) {
                $filledPreferenceCount += 1; // ✅ Count age as one filled field
            }
        }
        // dd($filledPreferenceCount);
        return view('user.find-match', compact('data', 'filledPreferenceCount'));
    }
}
