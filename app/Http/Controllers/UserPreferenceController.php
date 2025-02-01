<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPreferenceRequest;
use App\Http\Resources\UserPreferenceResource;
use App\Models\UserPreference;
use Illuminate\Http\Request;

class UserPreferenceController extends Controller
{
    /**
     * Store a newly created user preference.
     */
    public function store(UserPreferenceRequest $request)
    {
        $userPreference = UserPreference::create($request->validated());


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
     * Update the specified user preference.
     */
    public function update(UserPreferenceRequest $request, UserPreference $userPreference)
    {
        $userPreference->update($request->validated());

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
