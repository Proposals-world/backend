<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Http\Resources\UserProfileResource;
use Illuminate\Support\Facades\Auth;

class LikedMeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        // Get paginated likes with eager loading
        $likedUsers = Like::where('liked_user_id', $user->id)
            ->with([
                'user.photos',
                'user.hobbies',
                'user.pets',
                'user.profile.cityLocation', 'user.profile.nationality', 'user.profile.language',
                'user.profile.origin', 'user.profile.religion', 'user.profile.countryOfResidence',
                'user.profile.city', 'user.profile.zodiacSign', 'user.profile.educationalLevel',
                'user.profile.specialization', 'user.profile.jobTitle', 'user.profile.positionLevel',
                'user.profile.financialStatus', 'user.profile.housingStatus', 'user.profile.height',
                'user.profile.weight', 'user.profile.maritalStatus', 'user.profile.skinColor',
                'user.profile.hairColor', 'user.profile.drinkingStatus', 'user.profile.sportsActivity',
                'user.profile.socialMediaPresence', 'user.profile.sleepHabit', 'user.profile.religiosityLevel',
                'user.profile.marriageBudget', 'user.profile.smokingTools',
            ])
            ->paginate(9);
        $profiles = $likedUsers->through(function ($like) {
            $profileArray = (new UserProfileResource($like->user))->toArray(request());

            // Remove sensitive fields
            unset($profileArray['email'], $profileArray['phone_number']);

            return $profileArray;
        });
        // dd($profiles);
        return view('user.liked-me', [
            'profiles' => $profiles,
        ]);
    }
}