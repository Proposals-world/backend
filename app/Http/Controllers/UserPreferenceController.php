<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPreferenceRequest;
use App\Http\Resources\UserPreferenceResource;
use App\Models\UserPreference;
use Illuminate\Http\Request;

class UserPreferenceController extends Controller
{
    /**
     * Store or update a user preference using updateOrCreate.
     */
    public function store(UserPreferenceRequest $request)
    {
        // Create or update the user preference
        $userPreference = UserPreference::updateOrCreate(
            ['user_id' => $request->user()->id], // Search condition
            $request->validated()               // Data to insert or update
        );
        // dd($request);
        // Sync the preferred pets if provided
        if ($request->has('preferred_pets_id')) {
            $userPreference->pets()->sync($request->preferred_pets_id);
        }

        // Sync the preferred smoking tools if provided
        if ($request->has('preferred_smoking_tools')) {
            $userPreference->SmokingTools()->sync($request->preferred_smoking_tools);
        }

        // Sync the preferred languages if provided
        // if ($request->has('preferred_languages_id')) {
        //     // Sync the languages using the 'preferredLanguages' relationship on the User model
        //     $userPreference->user->preferredLanguages()->sync($request->preferred_languages_id);
        // }

        // Get the language header, default to 'en' if not provided
        $language = $request->header('Accept-Language', 'en');
        // dd($userPreference);
        // Return the user preference resource
        return new UserPreferenceResource($userPreference, $language);
    }

    /**
     * Display the specified user preference.
     */
    public function show(Request $request)
    {
        $user = $request->user();
        $language = $request->header('Accept-Language', 'en');
        if (!$user) {

            return response()->json([
                'message' => $language == 'ar' ? 'غير مصرح لك.' : 'Unauthorized.'
            ], 401);
        }

        $userPreference = UserPreference::where('user_id', $user->id)->first();

        if (!$userPreference) {
            return response()->json([
                'message' => $language == 'ar' ? 'لم يتم العثور على تفضيلات المستخدم.' : 'User preference not found.'
            ], 404);
        }

        return new UserPreferenceResource($userPreference, $request->header('Accept-Language', 'en'));
    }

    /**
     * Update or create the specified user preference.
     */
    // public function update(UserPreferenceRequest $request, UserPreference $userPreference)
    // {
    //     $user = $request->user();
    //     $userPreference = UserPreference::updateOrCreate(
    //         ['user_id' => $user->id], // Search condition
    //         $request->validated() // Data to insert or update
    //     );

    //     $language = $request->header('Accept-Language', 'en');

    //     return new UserPreferenceResource($userPreference, $language);
    // }

    /**
     * Remove the specified user preference.
     */
    public function destroy(UserPreference $userPreference, Request $request)
    {
        $userPreference->delete();

        $language = $request->header('Accept-Language', 'en');

        return response()->json([
            'message' => $language == 'ar' ? 'تم حذف تفضيلات المستخدم بنجاح.' : 'User preference deleted successfully.'
        ]);
    }
}
