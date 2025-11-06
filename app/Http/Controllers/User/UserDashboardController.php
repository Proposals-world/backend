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
use Carbon\Carbon;
use Illuminate\Container\Attributes\Auth as AttributesAuth;

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
            ->flatMap(fn($m) => [$m->user1_id, $m->user2_id])
            ->unique()
            ->reject(fn($id) => $id == Auth::id())   // drop my own id
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

        $feedbackOptions = [
            'Contacted Successfully' => [
                'en' => 'Contacted Successfully',
                'ar' => 'تم التواصل بنجاح',
            ],
            'Guardian Was Cooperative' => [
                'en' => 'Guardian Was Cooperative',
                'ar' => 'الولية كانت متعاونة',
            ],
            'Guardian Was Not Cooperative' => [
                'en' => 'Guardian Was Not Cooperative',
                'ar' => 'الولية لم تكن متعاونة',
            ],
            'Inappropriate Behavior' => [
                'en' => 'Inappropriate Behavior',
                'ar' => 'سلوك غير لائق',
            ],
            'No Response from Guardian' => [
                'en' => 'No Response from Guardian',
                'ar' => 'لا يوجد استجابة من الولية',
            ],
            'Engagement Happened' => [
                'en' => 'Engagement Happened',
                'ar' => 'حدثت خطوبة',
            ],
            'Marriage Happened' => [
                'en' => 'Marriage Happened',
                'ar' => 'تم الزواج',
            ],
            'Still in Communication' => [
                'en' => 'Still in Communication',
                'ar' => 'ما زلنا على تواصل',
            ],
            'Not Serious' => [
                'en' => 'Not Serious',
                'ar' => 'غير جاد',
            ],
            'Provided Guardian Number Invalid' => [
                'en' => 'Provided guardian number is not for a real guardian',
                'ar' => 'الرقم المقدم للولية ليس حقيقي',
            ],
        ];
        // if female, drop these keys in one go
        if (Auth::user()->gender === 'female') {
            $remove = [
                'Contacted Successfully',
                'Guardian Was Cooperative',
                'Guardian Was Not Cooperative',
                'No Response from Guardian',
                'Provided Guardian Number Invalid',
            ];
            $feedbackOptions = array_diff_key(
                $feedbackOptions,
                array_flip($remove)
            );
        }
        // Get the subscription end date

        $subscriptionEndsAt = Subscription::where('user_id', Auth::id())
            ->whereDate('end_date', '>=', Carbon::today()) // only future or today
            ->value('end_date'); // returns null if none

        $gender = Auth::user()->gender;

        $packageId = $gender === 'male' ? 999 : 1000;
        $hasActiveFreeSub = Subscription::where('user_id', Auth::id())
            ->where('package_id', $packageId)
            ->where('status', 'active')
            ->exists();

        $message = null;

        if (!$hasActiveFreeSub) {
            if ($gender === 'female') {
                $message = [
                    'ar' => 'مبارك لقد تم اختياركم للفوز باشتراك شهري مجاني بمناسبة افتتاح المنصة',
                    'en' => 'Congratulations! You have been selected for a free monthly subscription in celebration of our platform’s launch.',
                ];
            } elseif ($gender === 'male') {
                $message = [
                    'ar' => 'مبارك، لقد تم اختياركم للفوز باشتراك شهري بقيمة مكالمة واحدة بمناسبة افتتاح المنصة',
                    'en' => 'Congratulations! You have been selected for a monthly subscription with single call value to celebrate our platform launch.',
                ];
            }
        }

        return view('user.dashboard', [
            'matches'            => $transformed,
            'appLocale'          => $lang,
            'countOfHalfMatches' => $countOfHalfMatches,
            'countOfMatches'     => $countOfMatches,
            'remainingContacts'  => $remainingContacts,
            'feedbackOptions'    => $feedbackOptions,
            'subscriptionEndsAt' => $subscriptionEndsAt,
            'freeMessage' => $message,
        ]);
    }

    public function pricing()
    {
        $lang = $this->getAppLocale();
        $subscriptionCards = $this->getSubscriptionCards($lang);
        // dd($subscriptionCards);
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
        $userGender = Auth::user()->gender;

        $packages = SubscriptionPackage::where('gender', $userGender)->get();

        return $packages->map(function ($package) use ($lang, $userGender) {
            if ($userGender === "male") {
                return [
                    'package_name'  => $lang === 'ar' ? $package->package_name_ar : $package->package_name_en,
                    'price'         => $package->price,
                    'contact_limit' => $package->contact_limit,
                    "gender"      => $package->gender,
                ];
            } else { // female
                return [
                    'package_name' => $lang === 'ar' ? $package->package_name_ar : $package->package_name_en,
                    'price'        => $package->price,
                    'duration'     => $package->duration,
                    "gender"      => $package->gender,
                ];
            }
        });
    }
}
