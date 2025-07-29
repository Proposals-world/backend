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
use App\Models\Subscription;
use App\Models\UserReport;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LikeService
{
    public function getLikedMe()
    {
        $user = Auth::user();
        abort_unless($user, 403);
        $reportedUsers = UserReport::where('reporter_id', Auth::id())->pluck('reported_id');

        /* ------------------------------------------
         | 1. build an array of all my matched user-ids
         * ------------------------------------------*/
        $matchedUserIds = UserMatch::where(function ($q) use ($user) {
            $q->where('user1_id', $user->id)
                ->orWhere('user2_id', $user->id);
        })
            ->get()                       // each row has user1_id & user2_id
            ->flatMap(fn($m) => [$m->user1_id, $m->user2_id])
            ->unique()
            ->reject(fn($id) => $id == $user->id)   // toss my own id
            ->all();                     // ->all() returns plain array

        /* ------------------------------------------
         | 2. return likes that are NOT in that list
         * ------------------------------------------*/
        $likes = Like::where('liked_user_id', $user->id)
            ->whereNotIn('user_id', $matchedUserIds)
            ->whereNotIn('user_id', $reportedUsers)
            ->with('user.photos')
            ->get();

        return LikeResource::collection($likes); // default = false
    }

    public function getLikes()
    {
        $user = Auth::user();

        if (!$user) {
            return null;
        }

        $likes = Like::where('user_id', $user->id)
            ->with('likedUser.photos')
            ->get();

        return LikeResource::collection($likes->map(function ($like) {
            return new LikeResource($like, true); // viewedAsLiker = true
        }));
    }

    public function getMatches()
    {
        $user = Auth::user();

        if (!$user) {
            return null;
        }

        // Get users you reported
        $youReported = UserReport::where('reporter_id', $user->id)
            ->pluck('reported_id')
            ->toArray();

        // Get users who reported you
        $theyReportedYou = UserReport::where('reported_id', $user->id)
            ->pluck('reporter_id')
            ->toArray();

        // Combine both arrays
        $blockedUserIds = array_unique(array_merge($youReported, $theyReportedYou));

        $matches = UserMatch::with(['user1', 'user2'])
            ->where(function ($query) use ($user) {
                $query->where('user1_id', $user->id)
                    ->orWhere('user2_id', $user->id);
            })
            ->whereNotIn('user1_id', $blockedUserIds)
            ->whereNotIn('user2_id', $blockedUserIds)
            ->get();

        return MatchResource::collection($matches);
    }

    public function likeUserLogic($user, $likedUserId, $lang)
    {
        // $lang = request()->header('Accept-Language', app()->getLocale());
        // dd($lang);
        // this inforce the language to be either 'en' or 'ar' to make sure the email is sent in the correct language
        // App::setLocale($lang); // $lang is either 'en' or 'ar'
        $likedUser = User::find($likedUserId);

        if (!$likedUser) {
            return [
                'status' => 404,
                'type' => 'danger',
                'message' => $lang === 'ar' ? 'المستخدم غير موجود.' : 'User not found.'
            ];
        }

        if ($user->id === $likedUser->id) {
            return [
                'status' => 404,
                'type' => 'danger',
                'message' => $lang === 'ar' ? 'لا يمكنك الإعجاب بنفسك.' : 'You cannot like yourself.'
            ];
        }
        // Check if user is female and has no active subscription
        // dd($user->gender);
        if ($user->gender === 'female') {
            $activeSubscription = Subscription::where('user_id', $user->id)
                ->where('status', 'active')
                ->where('end_date', '>', now())
                ->exists();
            // dd($activeSubscription);
            if (!$activeSubscription) {
                return [
                    'status' => 403,
                    'type' => 'no_subscription',
                    'message' => $lang === 'ar'
                        ? 'عذرًا، يجب أن يكون لديك اشتراك نشط لتتمكن من الإعجاب بالمستخدمين.'
                        : 'Sorry, you need an active subscription to like other users.'
                ];
            }
        }
        $existingDislike = Dislike::where('user_id', $user->id)
            ->where('disliked_user_id', $likedUser->id)
            ->first();

        if ($existingDislike) {
            $existingDislike->delete();
        }

        if (
            Like::where('user_id', $user->id)
            ->where('liked_user_id', $likedUser->id)
            ->exists()
        ) {
            return [
                'status' => 400,
                'type' => 'danger',
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
            'type' => 'success',
            'message' => $lang === 'ar' ? 'تم الإعجاب بنجاح.' : 'Liked successfully.'
        ];
    }

    public function dislikeUserLogic($user, $dislikedUserId, $lang = 'en')
    {
        $dislikedUser = User::find($dislikedUserId);

        if (!$dislikedUser) {
            return [
                'status' => 403,
                'type' => 'danger',
                'message' => $lang === 'ar' ? 'المستخدم غير موجود.' : 'User not found.'
            ];
        }
        // Check if user is female and has no active subscription
        if ($user->gender === 'female') {
            $activeSubscription = Subscription::where('user_id', $user->id)
                ->where('status', 'active')
                ->where('end_date', '>', now())
                ->exists();

            if (!$activeSubscription) {
                return [
                    'status' => 403,
                    'type' => 'no_subscription',
                    'message' => $lang === 'ar'
                        ? 'عذرًا، يجب أن يكون لديك اشتراك نشط لتتمكن من عدم الاعجاب بالمستخدمين.'
                        : 'Sorry, you need an active subscription to dislike other users.'
                ];
            }
        }
        if (
            Dislike::where('user_id', $user->id)
            ->where('disliked_user_id', $dislikedUser->id)
            ->exists()
        ) {
            return [
                'status' => 400,
                'type' => 'danger',
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
            'type' => 'success',
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
