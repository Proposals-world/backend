<?php

namespace App\Services;

use App\Models\Like;
use App\Http\Resources\LikeResource;
use App\Http\Resources\MatchResource;
use App\Models\UserMatch;
use Illuminate\Support\Facades\Auth;

class LikeService
{
    public function getLikedMe()
    {
        $user = Auth::user();

        if (!$user) {
            return null; // Return null for unauthorized users
        }

        return LikeResource::collection(
            Like::where('liked_user_id', $user->id)
                ->with('user.photos')
                ->get()
        );
    }
    public function getLikes()
    {
        $user = Auth::user();

        if (!$user) {
            return null; // Return null for unauthorized users
        }

        return LikeResource::collection(
            Like::where('user_id', $user->id)
                ->with('user.photos')
                ->get()
        );
    }
    public function getMatches()
    {
        $user = Auth::user();

        if (!$user) {
            return null; // Return null for unauthorized users
        }

        $matches = UserMatch::with(['user1', 'user2'])
            ->where('user1_id', $user->id)
            ->orWhere('user2_id', $user->id)
            ->get();

        return MatchResource::collection($matches);
    }
}
