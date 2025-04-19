<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\OnboardingService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Services\UserProfileService;

class OnBoardingController extends Controller
{
    protected $onboardingService;
    protected $userProfileService;

    public function __construct(OnboardingService $onboardingService, UserProfileService $userProfileService)
    {
        $this->onboardingService = $onboardingService;
        $this->userProfileService = $userProfileService;
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

/**
     * Update the user's profile data and profile image (if provided) in one request.
     *
     * @param  \App\Http\Requests\UpdateUserProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfileAndImage(UpdateUserProfileRequest $request)
    {

        // dd($request);
        // dd($request->file('photo_url'));
        $user = $request->user();
        $data = $request->all();

        // If a new profile image is uploaded, update the profile image.
        if ($request->hasFile('photo_url')) {
            $user = $this->userProfileService->updateProfilePhoto($user, $request->file('photo_url'));
        }

        // Update the rest of the profile fields.
        $user = $this->userProfileService->updateProfile($user, $data, app()->getLocale());

        return redirect()->back()->with('success', __('onboarding.profile_updated_successfully'));
    }

    public function getCityLocationsByCity($cityId)
    {
        $locale    = app()->getLocale();
        $nameField = $locale === 'ar' ? 'name_ar' : 'name_en';

        $locations = DB::table('city_locations')
            ->select('id', DB::raw("$nameField as name"))
            ->where('city_id', $cityId)
            ->orderBy($nameField)
            ->get();

        return response()->json($locations);
    }
}