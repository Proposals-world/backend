<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserProfilePhotoRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Resources\UserProfileResource;
use App\Models\User;
use App\Services\UserProfileService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserProfileController extends Controller
{
    protected $userProfileService;

    /**
     * Inject the UserProfileService into the controller.
     *
     * @param UserProfileService $userProfileService
     */
    public function __construct(UserProfileService $userProfileService)
    {
        $this->userProfileService = $userProfileService;
    }

    /**
     * Display the authenticated user's profile.
     *
     * @param Request $request
     * @return Response
     */
    public function show(Request $request)
    {
        // Validate 'lang' parameter
        $lang = $request->header('Accept-Language', 'en');

        // Get the authenticated user
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => $lang === 'ar' ? 'غير مصرح به.' : 'Unauthorized.'
            ], 401);
        }

        // Fetch user profile using the service
        $userProfile = $this->userProfileService->getAuthenticatedUserProfile($user, $lang);

        if (!$userProfile) {
            return response()->json([
                'message' => $lang === 'ar' ? 'ملف المستخدم غير موجود.' : 'User profile not found.'
            ], 404);
        }

        // Return the user profile using the resource
        return new UserProfileResource($userProfile, $lang);
    }
    public function getUserWithProfile(Request $request)
    {
        // Validate 'lang' parameter
        $lang = $request->header('Accept-Language', 'en');
        // dd($lang);
        // Get the authenticated user
        // $user = User::where('id', $request->input('user_id'))->first();
        $userId = $request->input('user_id') ?? $request->query('user_id');

        $user = User::where('id', $userId)->first();

        if (!$user) {
            return response()->json([
                'message' => $lang === 'ar' ? 'غير مصرح به.' : 'Unauthorized.'
            ], 401);
        }

        // Fetch user profile using the service
        $userProfile = $this->userProfileService->getAuthenticatedUserProfile($user, $lang);

        if (!$userProfile) {
            return response()->json([
                'message' => $lang === 'ar' ? 'ملف المستخدم غير موجود.' : 'User profile not found.'
            ], 404);
        }

        // Return the user profile using the resource
        return new UserProfileResource($userProfile, $lang);
    }


    /**
     * Update the authenticated user's profile.
     *
     * @param UpdateUserProfileRequest $request
     * @return Response
     */
    public function update(UpdateUserProfileRequest $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized.'
            ], 401);
        }

        $validated = $request->validated();

        $lang = $request->header('Accept-Language', 'en');

        $userProfile = $this->userProfileService->updateProfile($user, $validated, $lang);

        return new UserProfileResource($userProfile, $lang);
    }
    /**
     * Update the authenticated user's profile photo.
     *
     * @param UpdateUserProfilePhotoRequest $request
     * @return Response
     */
    public function updateProfilePhoto(UpdateUserProfilePhotoRequest $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized.'
            ], 401);
        }

        $updatedUser = $this->userProfileService->updateProfilePhoto($user, $request->file('profile_photo'));

        return response()->json([
            'message' => 'Image updated successfully.'
        ], 200);
    }
}
