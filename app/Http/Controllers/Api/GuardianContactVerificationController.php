<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\GuardianOtp;
use App\Services\GuardianContactVerificationService;
use Illuminate\Support\Facades\Log;
use Throwable;

class GuardianContactVerificationController extends Controller
{
    public function send(Request $request, GuardianContactVerificationService $service)
    {
        try {
            $locale = $request->header('Accept-Language', 'en');
            $user = auth()->user();

            if (!$user || !$user->profile || !$user->profile->guardian_contact_encrypted) {
                return response()->json([
                    'message' => $locale === 'ar'
                        ? 'رقم ولي الأمر غير موجود في الملف الشخصي.'
                        : 'Guardian phone is not set in the profile.',
                ], 400);
            }
            $formattedPhone = $this->formatJordanianPhone($user->profile->guardian_contact_encrypted);
            $otp = rand(100000, 999999);

            GuardianOtp::create([
                'user_id'    => $user->id,
                'code'       => $otp,
                'expires_at' => Carbon::now()->addMinutes(5),
            ]);

            $service->sendVerificationCode($formattedPhone, $otp);

            return response()->json([
                'message' => $locale === 'ar'
                    ? 'تم إرسال رمز التحقق إلى ولي الأمر بنجاح.'
                    : 'OTP sent to guardian successfully.',
            ]);
        } catch (Throwable $e) {
            Log::error('Guardian OTP Send Error', ['error' => $e->getMessage()]);

            return response()->json([
                'message' => $request->header('Accept-Language') === 'ar'
                    ? 'حدث خطأ، يرجى المحاولة لاحقاً.'
                    : 'An error occurred. Please try again later.',
            ], 500);
        }
    }

    public function verify(Request $request)
    {
        try {
            $locale = $request->header('Accept-Language', 'en');

            $request->validate([
                'code' => 'required|string'
            ]);

            $user = auth()->user();

            if (!$user || !$user->profile || !$user->profile->guardian_contact_encrypted) {
                return response()->json([
                    'message' => $locale === 'ar'
                        ? 'رقم ولي الأمر غير موجود في الملف الشخصي.'
                        : 'Guardian phone is not set in the profile.',
                ], 400);
            }
            $formattedPhone = $this->formatJordanianPhone($user->profile->guardian_contact_encrypted);

            $record = GuardianOtp::where('user_id', $user->id)
                ->where('code', $request->code)
                ->where('expires_at', '>', now())
                ->first();

            if (!$record) {
                return response()->json([
                    'message' => $locale === 'ar'
                        ? 'الرمز غير صحيح أو منتهي الصلاحية.'
                        : 'Invalid or expired code.',
                ], 422);
            }

            $record->update(['verified' => true]);

            return response()->json([
                'message' => $locale === 'ar'
                    ? 'تم التحقق من رقم ولي الأمر بنجاح.'
                    : 'Guardian phone verified successfully.',
            ]);
        } catch (Throwable $e) {
            Log::error('Guardian OTP Verify Error', ['error' => $e->getMessage()]);

            return response()->json([
                'message' => $request->header('Accept-Language') === 'ar'
                    ? 'حدث خطأ، يرجى المحاولة لاحقاً.'
                    : 'An error occurred. Please try again later.',
            ], 500);
        }
    }
    private function formatJordanianPhone($phone): string
    {
        $phone = preg_replace('/[^0-9]/', '', $phone); // Keep digits only

        if (str_starts_with($phone, '0')) {
            $phone = substr($phone, 1); // Remove leading 0
        }

        if (!str_starts_with($phone, '962')) {
            $phone = '962' . $phone;
        }

        return '+' . $phone;
    }
}
