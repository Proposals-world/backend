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
        $userPreference = UserPreference::updateOrCreate(
            ['user_id' => $request->user()->id], // Search condition (assuming preferences are linked to users)
            $request->validated() // Data to insert or update
        );

        return new UserPreferenceResource($userPreference);
    }

    /**
     * Display the specified user preference.
     */
    public function show(UserPreference $userPreference)
    {
        return new UserPreferenceResource($userPreference);
    }

    /**
     * Update or create the specified user preference.
     */
    public function update(UserPreferenceRequest $request, UserPreference $userPreference)
    {
        $userPreference = UserPreference::updateOrCreate(
            ['user_id' => $request->user()->id], // Search condition
            $request->validated() // Data to insert or update
        );

        return new UserPreferenceResource($userPreference);
    }

    /**
     * Remove the specified user preference.
     */
    public function destroy(UserPreference $userPreference)
    {
        $userPreference->delete();

        return response()->json(['message' => 'User preference deleted successfully']);
    }
}
