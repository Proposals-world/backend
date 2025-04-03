<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserProfileResource;
use App\Http\Resources\LikeResource;
use App\Http\Resources\MatchResource; // Import MatchResource
use App\Models\User;
use App\Services\UserProfileService;
use App\Services\LikeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    protected $userProfileService;
    protected $likeService;

    public function __construct(UserProfileService $userProfileService, LikeService $likeService)
    {
        $this->userProfileService = $userProfileService;
        $this->likeService = $likeService;
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
        $formattedUserProfile = new UserProfileResource($userProfile, $request->input('lang', 'en'));

        // Pass the transformed data, likes, and matches to the view
        return view('user.profile.userProfile', [
            'userProfile' => $formattedUserProfile->resolve(),
            'likes' => $likes->resolve(),  // Add likes data to the view
            'matches' => $matches->resolve()  // Add matches data to the view
        ]);
    }
    public function updateProfile()
    {
        return view('user.profile.updateProfile');
    }
    public function viewUser(Request $request, string $id)
    {
        $user = User::find($id);

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
        $formattedUserProfile = new UserProfileResource($userProfile, $request->input('lang', 'en'));

        // Pass the transformed data, likes, and matches to the view
        return view('user.viewUser', [
            'userProfile' => $formattedUserProfile->resolve(),
            'likes' => $likes->resolve(),  // Add likes data to the view
            'matches' => $matches->resolve()  // Add matches data to the view
        ]);
    }
}
