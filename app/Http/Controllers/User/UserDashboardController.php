<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\MatchResource;
use App\Models\Like;
use App\Models\UserMatch;
use App\Models\SubscriptionPackage;
use App\Models\UserReport;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;

class UserDashboardController extends Controller
{
    public function index()
    {

        $reportedUsers = UserReport::where('reporter_id', Auth::id())->pluck('reported_id');

        /* ---------------------------------------------
         | 1. build an array with every user I’m matched to
         * --------------------------------------------*/
        $matchedUserIds = UserMatch::where(function ($q) {
                $q->where('user1_id', Auth::id())
                  ->orWhere('user2_id', Auth::id());
            })
            ->get()
            ->flatMap(fn ($m) => [$m->user1_id, $m->user2_id])
            ->unique()
            ->reject(fn ($id) => $id == Auth::id())   // drop my own id
            ->all();
    
        /* ------------------------------------------------
         | 2. likes-that-are-NOT-matches  (= “half matches”)
         * ------------------------------------------------*/
        $countOfHalfMatches = Like::where('liked_user_id', Auth::id())
                      ->whereNotIn('user_id', $matchedUserIds)
                      ->whereNotIn('user_id', $reportedUsers)
                      ->count();
    
        /* ------------- the rest of your original code -------------*/

        $countOfMatches = UserMatch::where(function ($query) {
            $query->where('user1_id', Auth::id())
            ->orWhere('user2_id', Auth::id());
        })
        ->whereNotIn('user1_id', $reportedUsers)
        ->whereNotIn('user2_id', $reportedUsers)
        ->count();

        $matches            = $this->getUserMatches();
        $transformed        = $this->transformMatches($matches);
        $lang               = $this->getAppLocale();
        $remainingContacts  = Subscription::where('user_id', Auth::id())
                                          ->value('contacts_remaining');
    
        return view('user.dashboard', [
            'matches'            => $transformed,
            'appLocale'          => $lang,
            'countOfHalfMatches' => $countOfHalfMatches,
            'countOfMatches'     => $countOfMatches,
            'remainingContacts'  => $remainingContacts,
        ]);
    }

    public function pricing()
    {
        $lang = $this->getAppLocale();
        $subscriptionCards = $this->getSubscriptionCards($lang);

        // dd($subscriptionCards);
        return view('user.pricing', compact('subscriptionCards'));
    }

    private function getUserMatches()
    {
        return UserMatch::with(['user1', 'user2'])
            ->where(function ($query) {
                $query->where('user1_id', Auth::id())
                    ->orWhere('user2_id', Auth::id());
            })
            ->where('contact_exchanged', 1)
            ->whereDoesntHave('feedback', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->latest()
            ->get();
    }

    private function transformMatches($matches)
    {
        return MatchResource::collection($matches)->resolve();
    }

    private function getAppLocale()
    {
        return app()->getLocale();
    }

    private function getSubscriptionCards($lang)
    {
        return SubscriptionPackage::all()->map(function ($package) use ($lang) {
            return [
                'package_name'   => $lang === 'ar' ? $package->package_name_ar : $package->package_name_en,
                'price'          => $package->price,
                'contact_limit'  => $package->contact_limit,
            ];
        });
    }
}
