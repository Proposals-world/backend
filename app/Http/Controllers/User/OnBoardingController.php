<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\OnboardingService;
use Illuminate\Support\Facades\DB;

class OnBoardingController extends Controller
{
    protected $onboardingService;

    public function __construct(OnboardingService $onboardingService)
    {
        $this->onboardingService = $onboardingService;
    }

    public function index(Request $request)
    {
        // Retrieve aggregated onboarding data with names based on current locale
        $data = $this->onboardingService->getOnboardingData();
        return view('onBoarding', compact('data'));
    }
    public function getCitiesByCountry($countryId)
    {
        $locale = app()->getLocale();
        $nameField = $locale === 'ar' ? 'name_ar' : 'name_en';

        $cities = DB::table('cities')
            ->select('id', DB::raw("{$nameField} as name"))
            ->where('country_id', $countryId)
            ->get();

        return response()->json($cities);
    }
}