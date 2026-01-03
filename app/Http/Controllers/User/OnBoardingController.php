<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\OnboardingService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Requests\UpdateUserProfilePart2Request;
use App\Services\UserProfileService;
use App\Services\WhatsAppContactService;

class OnBoardingController extends Controller
{
    protected $onboardingService;
    protected $userProfileService;
    protected $whatsAppContactService;


    public function __construct(OnboardingService $onboardingService, UserProfileService $userProfileService, WhatsAppContactService $whatsAppContactService)
    {
        $this->onboardingService = $onboardingService;
        $this->userProfileService = $userProfileService;
        $this->whatsAppContactService = $whatsAppContactService;
    }

    public function index(Request $request)
    {
        // Retrieve aggregated onboarding data with names based on current locale
        $fromupdate = true;
        $fromdesired = false;
        $data = $this->onboardingService->getOnboardingData($fromupdate, $fromdesired);
        return view('onBoarding', compact('data'));
    }
    public function completeOnboarding(Request $request)
    {
        // Retrieve aggregated onboarding data with names based on current locale
        $fromupdate = true;
        $fromdesired = false;
        $data = $this->onboardingService->getOnboardingData($fromupdate, $fromdesired);
        return view('onBoardingPart2', compact('data'));
    }
    public function getCitiesByCountry($countryId)
    {
        $locale = app()->getLocale();
        $nameField = $locale === 'ar' ? 'name_ar' : 'name_en';

        $cities = DB::table('cities')
            ->select('id', DB::raw("{$nameField} as name"))
            ->where('country_id', $countryId)
            ->orderBy($nameField, 'asc')
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
        try {
            $user = $request->user();
            $data = $request->all();

            // Update profile image if uploaded
            if ($request->hasFile('photo_url')) {
                $user = $this->userProfileService->updateProfilePhoto(
                    $user,
                    $request->file('photo_url')
                );
            }

            // Update other profile fields
            $user = $this->userProfileService->updateProfile(
                $user,
                $data,
                app()->getLocale()
            );

            // Validation of updateProfile response
            if (!empty($user['error'])) {
                return redirect()->back()->with('error', $user['error']);
            }

            // WhatsApp contact insertion
            $sessionId = $this->whatsAppContactService->getSessionId();

            if ($sessionId) {
                if ($user->gender === 'male') {

                    // Insert only phone number for male users
                    $this->whatsAppContactService->insert([
                        'sessionId' => $sessionId,
                        'id'        => $user->phone_number . "@s.whatsapp.net",
                    ]);
                } else {

                    // Insert woman's phone number
                    $this->whatsAppContactService->insert([
                        'sessionId' => $sessionId,
                        'id'        => $user->phone_number . "@s.whatsapp.net",
                    ]);

                    // Insert guardian contact also
                    $this->whatsAppContactService->insert([
                        'sessionId' => $sessionId,
                        'id'        => $user->profile->guardian_contact_encrypted . "@s.whatsapp.net",
                    ]);
                }
            }

            return redirect()->back()->with('success', __('Profile updated successfully'));
        } catch (\Exception $e) {

            // Optional: log the error
            \Log::error('Update Profile Error', [
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
            ]);

            return redirect()->back()->with('error', __('Something went wrong, please try again.'));
        }
    }
    /**
     * Update the user's profile data and profile image (if provided) in one request.
     *
     * @param  \App\Http\Requests\UpdateUserProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfileAndImagePart2(UpdateUserProfilePart2Request $request)
    {
        try {
            $user = $request->user();
            $data = $request->all();

            // Update profile image if uploaded
            if ($request->hasFile('photo_url')) {
                $user = $this->userProfileService->updateProfilePhoto(
                    $user,
                    $request->file('photo_url')
                );
            }

            // Update other profile fields
            $user = $this->userProfileService->updateProfile(
                $user,
                $data,
                app()->getLocale()
            );

            // Validation of updateProfile response
            if (!empty($user['error'])) {
                return redirect()->back()->with('error', $user['error']);
            }

            // WhatsApp contact insertion
            $sessionId = $this->whatsAppContactService->getSessionId();

            if ($sessionId) {
                if ($user->gender === 'male') {

                    // Insert only phone number for male users
                    $this->whatsAppContactService->insert([
                        'sessionId' => $sessionId,
                        'id'        => $user->phone_number . "@s.whatsapp.net",
                    ]);
                } else {

                    // Insert woman's phone number
                    $this->whatsAppContactService->insert([
                        'sessionId' => $sessionId,
                        'id'        => $user->phone_number . "@s.whatsapp.net",
                    ]);

                    // Insert guardian contact also
                    $this->whatsAppContactService->insert([
                        'sessionId' => $sessionId,
                        'id'        => $user->profile->guardian_contact_encrypted . "@s.whatsapp.net",
                    ]);
                }
            }

            return redirect()->route('user.dashboard')->with('success', __('Profile updated successfully'));
        } catch (\Exception $e) {

            // Optional: log the error
            \Log::error('Update Profile Error', [
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
            ]);

            return redirect()->back()->with('error', __('Something went wrong, please try again.'));
        }
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
    public function getReligiousLevels(Request $request)
    {
        $religionId = $request->input('religion_id');
        $gender = $request->input('gender');
        // dd($gender);
        return $this->onboardingService->getSpecificReligiousLevels($religionId, $gender);
    }
}
