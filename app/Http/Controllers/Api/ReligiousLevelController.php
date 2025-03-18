<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReligiousLevelResource;
use App\Models\ReligiosityLevel;
use Illuminate\Http\Request;

class ReligiousLevelController extends Controller
{
    /**
     * Display the religiosity levels based on the user's gender.
     */
    public function index(Request $request)
    {
        // Retrieve the authenticated user (ensure your auth middleware is applied)
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        // Convert the user's gender ('male' or 'female') to the corresponding integer value.
        // For example: male => 1, female => 2.
        $gender = $user->gender === 'male' ? 1 : 2;

        // Retrieve religiosity levels based on the gender
        $religiosityLevels = ReligiosityLevel::where('gender', $gender)->get();

        // Return the collection using the ReligiousLevelResource
        return ReligiousLevelResource::collection($religiosityLevels);
    }
}
