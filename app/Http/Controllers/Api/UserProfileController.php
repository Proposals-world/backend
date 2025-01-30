<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Resources\UserProfileResource;
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
        $validated = $request->validate([
            'lang' => 'nullable|in:en,ar',
        ]);

        // Retrieve 'lang' parameter from query string, default to 'en'
        $lang = $validated['lang'] ?? 'en';

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
}