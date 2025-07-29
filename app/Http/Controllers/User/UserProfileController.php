<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserProfileResource;
use App\Http\Resources\LikeResource;
use App\Http\Resources\MatchResource; // Import MatchResource
use App\Http\Resources\UserPreferenceResource;
use App\Models\User;
use App\Services\UserProfileService;
use App\Services\LikeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\User\OnboardingService;

class UserProfileController extends Controller
{
    protected $userProfileService;
    protected $likeService;
    protected $onboardingService;

    public function __construct(UserProfileService $userProfileService, LikeService $likeService, OnboardingService $onboardingService)
    {
        $this->userProfileService = $userProfileService;
        $this->likeService = $likeService;
        $this->onboardingService = $onboardingService;
    }

    public function index(Request $request)
    {
        $user = Auth::user(); // Get authenticated user

        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to access your profile.');
        }

        // Get user profile data from UserProfileService
        $userProfile = $this->userProfileService->getAuthenticatedUserProfile($user);

        // Get likes data using LikeService
        $likes = $this->likeService->getLikes();

        // Get matches data using LikeService
        $matches = $this->likeService->getMatches();  // Call getMatches()

        // Transform the user profile using UserProfileResource
        $formattedUserProfile = new UserProfileResource($userProfile, app()->getLocale());
        // dd($formattedUserProfile->resolve());
        // Pass the transformed data, likes, and matches to the view
        return view('user.profile.userProfile', [
            'userProfile' => $formattedUserProfile->resolve(),
            'likes' => $likes->resolve(),
            'matches' => $matches->resolve()
        ]);
    }
    public function desired(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to access your profile.');
        }

        // ✅ Use the method correctly as a relationship
        $userPreferences = $user->preference()->firstOrNew([
            'user_id' => $user->id
        ]);

        $data = $this->onboardingService->getOnboardingData();

        $formattedUserPreferences = new UserPreferenceResource($userPreferences, app()->getLocale());
        // dd($formattedUserPreferences->resolve());
        return view('user.desiredPartnerCharacteristics.partnerProfile', [
            'userPreferences' => $formattedUserPreferences->resolve(),
            'data' => $data
        ]);
    }





    public function updateProfile()
    {
        $user = Auth::user(); // Get the authenticated user
        $locale = app()->getLocale(); // Get the app locale (en or ar)

        // Pass the locale to the service to load localized profile data
        $profile = $this->userProfileService->getAuthenticatedUserProfile($user, $locale);

        // if (! $user->profile->canBeUpdated()) {
        //     $next = $user->profile->nextAllowedUpdateAt()
        //         ->format('d/m/Y H:i:s');

        //     return redirect()->route('user.profile')->with([
        //         'error' => __('profile.update_restriction') . $next,
        //     ]);
        // }

        // dd($user->phone_number, $user->profile->guardian_contact);
        $data = $this->onboardingService->getOnboardingData();
        // dd($profile);
        return view('user.profile.updateProfile', compact('user', 'profile', 'data', 'locale'));
    }
}
