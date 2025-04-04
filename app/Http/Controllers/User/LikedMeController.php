<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\UserMatch;
use App\Http\Resources\UserProfileResource;
use Illuminate\Support\Facades\Auth;
use App\Services\LikeService;
use Illuminate\Http\Request;

class LikedMeController extends Controller
{
    protected $likeService;
    protected $lang;

    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
        $this->lang = app()->getLocale();
    }

    public function index()
    {
        $user = Auth::user();
    
        if (!$user) {
            abort(403, 'Unauthorized');
        }
    
        // Get matched users to exclude
        $matchedUserIds = UserMatch::where('user1_id', $user->id)
            ->orWhere('user2_id', $user->id)
            ->get()
            ->flatMap(function ($match) use ($user) {
                return collect([$match->user1_id, $match->user2_id])->reject(fn($id) => $id === $user->id);
            })->unique();
    
        // Get disliked users to exclude
        $dislikedUserIds = \App\Models\Dislike::where('user_id', $user->id)
            ->pluck('disliked_user_id')
            ->unique();
    
        // Get paginated likes excluding matched and disliked users
        $likedUsers = Like::where('liked_user_id', $user->id)
            ->whereHas('user')
            ->whereNotIn('user_id', $matchedUserIds)
            ->whereNotIn('user_id', $dislikedUserIds)
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
            $profileArray = (new UserProfileResource($like->user, $this->lang))->toArray(request());
    
            unset($profileArray['email'], $profileArray['phone_number']);
    
            return $profileArray;
        });
    
        return view('user.liked-me', [
            'profiles' => $profiles,
        ]);
    }

    public function like(Request $request)
    {
        $user = Auth::user();
        $response = $this->likeService->likeUserLogic($user, $request->liked_user_id, $this->lang);

        return redirect()->back()->with('status', $response['message']);
    }

    public function dislike(Request $request)
    {
        $user = Auth::user();
        $response = $this->likeService->dislikeUserLogic($user, $request->disliked_user_id, $this->lang);

        return redirect()->back()->with('status', $response['message']);
    }
}