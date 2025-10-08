<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Dislike;
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
        abort_unless($user, 403, 'Unauthorized');

        // 1. get all likes that point to *me*
        $likes = $this->likeService->getLikedMe();   // LikeResource collection

        // 2. convert every LikeResource -> UserProfileResource -> array
        $language = request()->header('Accept-Language', app()->getLocale());

        $profiles = $likes->map(function ($likeResource) use ($language) {
            /** @var \App\Models\Like $like  actual model behind the resource */
            $like = $likeResource->resource;

            // build the structure the blade expects
            $profileArr = (new UserProfileResource(
                $like->user,
                $language
            ))->toArray(request());

            // hide e-mail / phone if you don’t need them
            unset($profileArr['email'], $profileArr['phone_number']);

            return $profileArr;
        });

        return view('user.liked-me', ['profiles' => $profiles]);
    }

    public function like(Request $request)
    {
        $user = Auth::user();
        // dd($user->gender);
        $lang = app()->getLocale();
        $response = $this->likeService->likeUserLogic($user, $request->liked_user_id, $lang);
        if ($response['status'] === 200) {
            $response['type'] = 'success';
        } else {
            $response['type'] = 'danger';
        }
        return redirect()->back()->with('status', $response['message'])
            ->with('alert-type', $response['type']);
    }

    public function dislike(Request $request)
    {
        $user = Auth::user();
        $lang = app()->getLocale();

        $response = $this->likeService->dislikeUserLogic($user, $request->disliked_user_id, $lang);

        return redirect()->back()->with('status', $response['message'])
            ->with('alert-type', $response['type']);
        // ->with('alert-type', $response['type'])
    }
}
