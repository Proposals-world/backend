<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MatchResource;
use App\Models\Like;
use App\Models\Subscription;
use App\Models\UserMatch;
use App\Services\ContactMaskingService;
use App\Services\LikeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchController extends Controller
{
    protected $likeService;
    protected $contactMaskingService;

    public function __construct(LikeService $likeService, ContactMaskingService $contactMaskingService)
    {
        $this->likeService = $likeService;
        $this->contactMaskingService = $contactMaskingService;
    }
    public function getMatches()
    {
        $matches = $this->likeService->getMatches();

        if ($matches === null) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json([
            'message' => 'Matches fetched successfully',
            'matches' => $matches
        ], 200);
    }
    public function removeMatch(Request $request)
    {
        // ✅ Just call the service and return its result
        return $this->likeService->softDeleteMatch($request);
    }
    public function revealContact(Request $request)
    {
        $matchedUserId = $request->input('matchedUserId');
        $user = Auth::user();
        $lang = $request->header('Accept-Language', 'en');

        // ✅ Get active subscription
        $subscription = Subscription::where('user_id', $user->id)
            ->where('end_date', '>', now())
            ->orderByDesc('end_date')
            ->first();

        // 🚫 No active subscription
        if (!$subscription || now()->greaterThan($subscription->end_date)) {
            $errorMessage = $lang === 'ar'
                ? 'يجب أن تكون مشتركًا فعالًا لكشف معلومات الاتصال (انتهى الاشتراك أو غير مفعل).'
                : 'You must have an active subscription to reveal contact info (expired or inactive).';

            return response()->json(['error' => $errorMessage], 403);
        }

        // 🚫 Free package (999) cannot be used unless user has a paid subscription
        if ($subscription->package_id == 999) {
            $hasPaidSub = Subscription::where('user_id', $user->id)
                ->where('package_id', '!=', 999)
                ->exists();

            if (!$hasPaidSub) {
                $errorMessage = $lang === 'ar'
                    ? 'لا يمكنك استخدام الباقة المجانية حتى تقوم بشراء أي باقة مدفوعة.'
                    : 'You cannot use the free subscription until you purchase any paid plan.';

                return response()->json(['error' => $errorMessage], 403);
            }
        }

        // 🚫 No remaining contact reveals
        if ($subscription->contacts_remaining <= 0) {
            $errorMessage = $lang === 'ar'
                ? 'ليس لديك أي اظهارات متبقية لجهات الاتصال.'
                : 'You have no remaining contact reveals.';

            return response()->json(['error' => $errorMessage], 403);
        }

        // ✅ Reveal contact info
        $result = $this->contactMaskingService->getContactInfo($user->id, $matchedUserId);

        // ✅ Decrease remaining contacts only if successful
        if (!isset($result['error'])) {
            $subscription->decrement('contacts_remaining');
        }

        return response()->json($result, isset($result['error']) ? 404 : 200);
    }
}
