<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Match;
use App\Models\Dislike;
use App\Models\MatchedUser;
use App\Models\User;
use App\Models\UserMatch;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function likeUser(Request $request)
    {
        // $user = auth()->user();
        $user = Auth::user();
        $likedUser = User::find($request->liked_user_id);

        if (!$likedUser) {
            return response()->json(['message' => 'User not found.'], 404);
        }
        if ($user->id  == $likedUser->id) {
            return response()->json(['message' => 'You can not like youself.'], 404);
        }

        // Check if the dislike exists and remove it
        $existingLike = Dislike::where('user_id', $user->id)->where('disliked_user_id', $likedUser->id)->first();
        if ($existingLike) {
            $existingLike->delete();  // Remove the like if it exists
        }
        // Check if the user already liked this person
        if (Like::where('user_id', $user->id)->where('liked_user_id', $likedUser->id)->exists()) {
            return response()->json(['message' => 'Already liked this user.'], 400);
        }
        // Save the like
        $like = Like::create([
            'user_id' => $user->id,
            'liked_user_id' => $likedUser->id,
        ]);
        // Check if the liked user also liked the current user
        if (Like::isMatch($likedUser->id, $user->id)) {
            UserMatch::create([
                'user1_id' => $user->id,
                'user2_id' => $likedUser->id,
                'match_status' => "pending",
                'contact_exchanged' => 0,
            ]);

            return response()->json(['message' => 'It’s a match! 🎉'], 200);
        }

        return response()->json(['message' => 'Liked successfully.'], 200);
    }

    public function dislikeUser(Request $request)
    {
        $user = Auth::user();
        $dislikedUser = User::find($request->disliked_user_id);

        // Check if disliked user exists
        if (!$dislikedUser) {
            return response()->json(['message' => 'User not found.'], 403);
        }

        // Check if the user has already disliked this person
        if (Dislike::where('user_id', $user->id)->where('disliked_user_id', $dislikedUser->id)->exists()) {
            return response()->json(['message' => 'You have already disliked this user.'], 400);
        }

        // Check if the like exists and remove it
        $existingLike = Like::where('user_id', $user->id)->where('liked_user_id', $dislikedUser->id)->first();
        if ($existingLike) {
            $existingLike->delete();  // Remove the like if it exists
        }

        // Save the dislike
        Dislike::create([
            'user_id' => $user->id,
            'disliked_user_id' => $dislikedUser->id,
        ]);

        return response()->json(['message' => 'Disliked successfully.'], 200);
    }
}
