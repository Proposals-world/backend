<?php

namespace App\Services;

use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class RevealContactService
{
    protected $contactMaskingService;

    public function __construct(ContactMaskingService $contactMaskingService)
    {
        $this->contactMaskingService = $contactMaskingService;
    }

    /**
     * Handle reveal contact logic
     */
    public function reveal($matchedUserId, $lang = 'en')
    {
        $user = Auth::user();

        // 1) Get active subscription
        $subscription = Subscription::where('user_id', $user->id)
            ->where('end_date', '>', now())
            ->orderByDesc('end_date')
            ->first();

        if (!$subscription || now()->greaterThan($subscription->end_date)) {
            return [
                'error' => $lang === 'ar'
                    ? 'يجب أن تكون مشتركًا فعالًا لكشف معلومات الاتصال (انتهى الاشتراك أو غير مفعل).'
                    : 'You must have an active subscription to reveal contact info (expired or inactive).',
                'status' => 403
            ];
        }

        // 2) Free package rule (999)
        if ($subscription->package_id == 999) {
            $hasPaidSub = Subscription::where('user_id', $user->id)
                ->where('package_id', '!=', 999)
                ->exists();

            if (!$hasPaidSub) {
                return [
                    'error' => $lang === 'ar'
                        ? 'لا يمكنك استخدام الباقة المجانية حتى تقوم بشراء أي باقة مدفوعة.'
                        : 'You cannot use the free subscription until you purchase any paid plan.',
                    'status' => 403
                ];
            }
        }

        // 3) No remaining contact reveals
        if ($subscription->contacts_remaining <= 0) {
            return [
                'error' => $lang === 'ar'
                    ? 'ليس لديك أي اظهارات متبقية لجهات الاتصال.'
                    : 'You have no remaining contact reveals.',
                'status' => 403
            ];
        }

        // 4) Reveal contact via masking service
        $result = $this->contactMaskingService->getContactInfo($user->id, $matchedUserId);

        // 5) Decrease remaining credits only if successful
        if (!isset($result['error']) && $subscription->contacts_remaining > 0) {
            $subscription->contacts_remaining = max(0, $subscription->contacts_remaining - 1);
            $subscription->save();
            return [
                'data' => $result,
                'status' => 200
            ];
        }

        return [
            'error' => $result['error'],
            'status' => 404
        ];
    }
}
