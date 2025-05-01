<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\MatchResource;
use App\Models\Like;
use App\Models\UserMatch;
use App\Models\SubscriptionPackage;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;

class UserDashboardController extends Controller
{
    public function index()
    {
        $matches = $this->getUserMatches();
        $transformed = $this->transformMatches($matches);
        $lang = $this->getAppLocale();
        $countOfHalfMatches = Like::where('liked_user_id', Auth::id())->count();
        $countOfMatches = UserMatch::where(function ($query) {
            $query->where('user1_id', Auth::id())
                ->orWhere('user2_id', Auth::id());
        })
            ->count();
        $remainingContacts = Subscription::where('user_id', Auth::id())->value('contacts_remaining');

        // dd($countOfMatches);
        return view('user.dashboard', [
            'matches' => $transformed,
            'appLocale' => $lang,
            'countOfHalfMatches' => $countOfHalfMatches,
            'countOfMatches' => $countOfMatches,
            'remainingContacts' => $remainingContacts,
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
