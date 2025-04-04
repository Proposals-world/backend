<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LikeResource;
use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Match;
use App\Models\Dislike;
use App\Models\MatchedUser;
use App\Models\User;
use App\Models\UserMatch;
use App\Services\LikeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    protected $likeService;

    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    public function likeUser(Request $request)
    {
        $user = Auth::user();
        $result = $this->likeService->likeUserLogic($user, $request->liked_user_id);
        return response()->json(['message' => $result['message']], $result['status']);
    }
    
    public function dislikeUser(Request $request)
    {
        $user = Auth::user();
        $result = $this->likeService->dislikeUserLogic($user, $request->disliked_user_id);
        return response()->json(['message' => $result['message']], $result['status']);
    }

    public function getLikes(): JsonResponse
    {
        $likes = $this->likeService->getLikes();

        if ($likes === null) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json([
            'message' => 'Likes fetched successfully',
            'likes' => $likes
        ], 200);
    }

    //Liked me

    public function getLikedMe()
    {
        $likedBy = $this->likeService->getLikedMe();

        if ($likedBy === null) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json([
            'message' => 'Liked by users fetched successfully',
            'liked_by' => $likedBy
        ], 200);
    }
}
