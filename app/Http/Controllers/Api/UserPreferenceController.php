<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

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
        // dd($request->validated());

        $data = $request->validated();

        // count only the “filled” preference fields
        $nonEmpty = collect($data)
            ->reject(function ($value) {
                // drop nulls, empty strings, empty arrays
                if (is_null($value) || $value === '') {
                    return true;
                }
                if (is_array($value) && count(array_filter($value, fn($v) => $v !== null && $v !== '' && $v !== 'null')) === 0) {
                    return true;
                }
                return false;
            })
            ->count();

        if ($nonEmpty > 10) {
            return response()->json([
                'message' => __('profile.You can select up to 10 fields.'),
            ], 422);
        }

        // Create or update the user preference
        $userPreference = UserPreference::updateOrCreate(
            ['user_id' => $request->user()->id],
            $data
        );
        // dd($request->validated(), $userPreference->getFillable());
        // dd($userPreference);
        // dd($request);
        // Sync the preferred pets if provided
        if ($request->has('preferred_pets_id')) {
            $userPreference->pets()->sync($request->preferred_pets_id);
        }
        // Sync the preferred hobbies if provided

        if ($request->has('preferred_hobbies_id')) {
            $userPreference->hobbies()->sync($request->preferred_hobbies_id);
        }

        // Sync the preferred smoking tools if provided
        if ($request->has('preferred_smoking_tools')) {
            $userPreference->SmokingTools()->sync($request->preferred_smoking_tools);
        }

        // Sync the preferred languages if provided
        // if ($request->has('preferred_languages_id')) {
        //     // Sync the languages using the 'preferredLanguages' relationship on the User model
        //     $userPreference->user->preferredLanguages()->sync($request->preferr1ed_languages_id);
        // }

        // Get the language header, default to 'en' if not provided
        $language = $request->header('Accept-Language', 'en');
        // dd($userPreference);
        // Return the user preference resource
        return new UserPreferenceResource($userPreference, $language);
    }

    public function updateChangedData(UserPreferenceRequest $request)
    {

        try {
            // Retrieve the current user preference (if any)
            $userPreference = UserPreference::firstOrNew(['user_id' => $request->user()->id]);

            // Get the validated data from the request
            $validatedData = $request->validated();

            // Iterate over the validated data and update only the changed data
            foreach ($validatedData as $key => $value) {
                // If the value has changed, update the field
                if ($userPreference->$key !== $value) {
                    $userPreference->$key = $value;
                }
            }

            // Save the updated or new user preference
            $userPreference->save();

            // Sync the preferred pets if provided
            if ($request->has('preferred_pets_id')) {
                $userPreference->pets()->sync($request->preferred_pets_id);
            }

            // Sync the preferred smoking tools if provided
            if ($request->has('preferred_smoking_tools')) {
                $userPreference->SmokingTools()->sync($request->preferred_smoking_tools);
            }

            // Sync the preferred languages if provided
            if ($request->has('preferred_languages_id')) {
                $userPreference->user->preferredLanguages()->sync($request->preferred_languages_id);
            }

            // Get the language header, default to 'en' if not provided
            $language = $request->header('Accept-Language', 'en');

            // Return a success response with the updated user preference data
            return response()->json([
                'status' => 'success',
                'message' => 'User preferences updated successfully.',
                'data' => new UserPreferenceResource($userPreference, $language)
            ], 200);
        } catch (\Exception $e) {
            // Return an error response if something goes wrong
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
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
