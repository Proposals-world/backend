<?php
// App\Services\LikeService.php

namespace App\Services;

use App\Models\Like;
use App\Models\Dislike;
use App\Models\User;
use App\Models\UserMatch;
use App\Http\Resources\LikeResource;
use App\Http\Resources\MatchResource;
use App\Mail\LikedNotification;
use App\Mail\MatchNotification;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LikeService
{
    public function getLikedMe()
    {
        $user = Auth::user();

        if (!$user) {
            return abort(403);
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
            return null;
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
            return null;
        }

        $matches = UserMatch::with(['user1', 'user2'])
            ->where('user1_id', $user->id)
            ->orWhere('user2_id', $user->id)
            ->get();

        return MatchResource::collection($matches);
    }

    public function likeUserLogic($user, $likedUserId, $lang = 'en')
    {
        $lang = request()->header('Accept-Language', app()->getLocale());
        // this inforce the language to be either 'en' or 'ar' to make sure the email is sent in the correct language
        // App::setLocale($lang); // $lang is either 'en' or 'ar'
        $likedUser = User::find($likedUserId);

        if (!$likedUser) {
            return [
                'status' => 404,
                'message' => $lang === 'ar' ? 'المستخدم غير موجود.' : 'User not found.'
            ];
        }

        if ($user->id === $likedUser->id) {
            return [
                'status' => 404,
                'message' => $lang === 'ar' ? 'لا يمكنك الإعجاب بنفسك.' : 'You cannot like yourself.'
            ];
        }

        $existingDislike = Dislike::where('user_id', $user->id)
            ->where('disliked_user_id', $likedUser->id)
            ->first();

        if ($existingDislike) {
            $existingDislike->delete();
        }

        if (Like::where('user_id', $user->id)
            ->where('liked_user_id', $likedUser->id)
            ->exists()
        ) {
            return [
                'status' => 400,
                'message' => $lang === 'ar' ? 'لقد أعجبت بهذا المستخدم مسبقاً.' : 'Already liked this user.'
            ];
        }

        Like::create([
            'user_id' => $user->id,
            'liked_user_id' => $likedUser->id,
        ]);
        // Send notification email to liked user
        \Mail::to($likedUser->email)->send(new LikedNotification($user));

        if (Like::isMatch($likedUser->id, $user->id)) {
            UserMatch::create([
                'user1_id' => $user->id,
                'user2_id' => $likedUser->id,
                'match_status' => 'pending',
                'contact_exchanged' => 0,
            ]);
            // Send email to both users
            \Mail::to($user->email)->send(new MatchNotification($user, $likedUser));
            \Mail::to($likedUser->email)->send(new MatchNotification($likedUser, $user));

            return [
                'status' => 200,
                'message' => $lang === 'ar' ? 'إنه تطابق! 🎉' : 'It’s a match! 🎉'
            ];
        }

        return [
            'status' => 200,
            'message' => $lang === 'ar' ? 'تم الإعجاب بنجاح.' : 'Liked successfully.'
        ];
    }

    public function dislikeUserLogic($user, $dislikedUserId, $lang = 'en')
    {
        $dislikedUser = User::find($dislikedUserId);

        if (!$dislikedUser) {
            return [
                'status' => 403,
                'message' => $lang === 'ar' ? 'المستخدم غير موجود.' : 'User not found.'
            ];
        }

        if (Dislike::where('user_id', $user->id)
            ->where('disliked_user_id', $dislikedUser->id)
            ->exists()
        ) {
            return [
                'status' => 400,
                'message' => $lang === 'ar' ? 'لقد قمت برفض هذا المستخدم مسبقاً.' : 'You have already disliked this user.'
            ];
        }

        $existingLike = Like::where('user_id', $user->id)
            ->where('liked_user_id', $dislikedUser->id)
            ->first();

        if ($existingLike) {
            $existingLike->delete();
        }

        Dislike::create([
            'user_id' => $user->id,
            'disliked_user_id' => $dislikedUser->id,
        ]);

        return [
            'status' => 200,
            'message' => $lang === 'ar' ? 'تم الرفض بنجاح.' : 'Disliked successfully.'
        ];
    }

    public function softDeleteMatch($request)
    {
        $matchId = $request->input('match_id');
        $language = $request->header('Accept-Language', 'en');

        if (!$matchId) {
            $message = $language === 'ar' ? 'معرف التطابق مطلوب' : 'Match ID is required';
            return response()->json(['message' => $message], 400);
        }

        // Fetch match without trashed
        $match = UserMatch::where('id', $matchId)->first();

        if (!$match) {
            $message = $language === 'ar' ? 'التطابق غير موجود أو تم حذفه بالفعل' : 'Match not found or already deleted';
            return response()->json(['message' => $message], 404);
        }

        // Perform soft delete
        $match->delete();

        // Optionally remove related likes (permanently)
        Like::where(function ($q) use ($match) {
            $q->where('user_id', $match->user1_id)->where('liked_user_id', $match->user2_id);
        })->orWhere(function ($q) use ($match) {
            $q->where('user_id', $match->user2_id)->where('liked_user_id', $match->user1_id);
        })->delete();

        $message = $language === 'ar' ? 'تمت إزالة التطابق بنجاح' : 'Match removed successfully';
        return response()->json(['message' => $message], 200);
    }
}
