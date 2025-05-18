<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\GuardianOtp;
use App\Services\GuardianContactVerificationService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use Throwable;

class GuardianContactVerificationController extends Controller
{
    // fix it edit to take the last send or resent the same code
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
            if ($user->profile->guardian_contact_encrypted === $user->phone) {
                return response()->json([
                    'message' => $locale === 'ar'
                        ? 'رقم ولي الأمر لا يمكن أن يكون نفس رقم المستخدم.'
                        : 'Guardian phone cannot be the same as the user phone.',
                ], 400);
            }

            $formattedPhone = $this->formatJordanianPhone($user->profile->guardian_contact_encrypted);

            // 🛠 Check if existing OTP still valid
            $existingOtp = GuardianOtp::where('user_id', $user->id)
                ->where('expires_at', '>', now())
                ->where('verified', false)
                ->latest()
                ->first();

            if ($existingOtp) {
                $otp = $existingOtp->code;  // Use existing OTP
            } else {
                // 🛠 Generate new OTP
                $otp = rand(100000, 999999);

                GuardianOtp::create([
                    'user_id'    => $user->id,
                    'code'       => $otp,
                    'expires_at' => now()->addMinutes(15),
                ]);
            }

            // 🛠 Always send the OTP (existing or new)
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

            // 🛠 Only check the newest, latest OTP
            $record = GuardianOtp::where('user_id', $user->id)
                ->where('expires_at', '>', now())
                ->where('verified', false) // Ensure it's not already verified
                ->latest()  // <- get newest one first
                ->first();

            // 🛠 Now check if it matches the submitted code
            if (!$record || $record->code !== $request->code) {
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



    public function updateGuardianContact(Request $request)
    {
        try {
            $locale = $request->header('Accept-Language', 'en');

            $validator = Validator::make($request->all(), [
                'guardian_contact' => [
                    'required',
                    'digits:10',
                    'regex:/^07[0-9]{8}$/',
                ],
            ], [
                'guardian_contact.required' => $locale === 'ar'
                    ? 'رقم ولي الأمر مطلوب.'
                    : 'Guardian contact is required.',
                'guardian_contact.digits' => $locale === 'ar'
                    ? 'رقم ولي الأمر يجب أن يكون مكوناً من 10 أرقام.'
                    : 'Guardian contact must be exactly 10 digits.',
                'guardian_contact.regex' => $locale === 'ar'
                    ? 'رقم ولي الأمر يجب أن يبدأ بـ 07 ويتبعه 8 أرقام.'
                    : 'Guardian contact must start with 07 followed by 8 digits.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first(),
                ], 422);
            }

            $user = auth()->user();

            if (!$user || !$user->profile) {
                return response()->json([
                    'message' => $locale === 'ar'
                        ? 'الملف الشخصي غير موجود.'
                        : 'User profile not found.',
                ], 400);
            }


            $user->profile->update([
                'guardian_contact_encrypted' => $formattedPhone,
            ]);
            $formattedPhone = $this->formatJordanianPhone($request->guardian_contact);

            return response()->json([
                'message' => $locale === 'ar'
                    ? 'تم تحديث رقم ولي الأمر بنجاح.'
                    : 'Guardian contact updated successfully.',
            ]);
        } catch (Throwable $e) {
            Log::error('Guardian Contact Update Error', ['error' => $e->getMessage()]);

            return response()->json([
                'message' => $locale === 'ar'
                    ? 'حدث خطأ، يرجى المحاولة لاحقاً.'
                    : 'An error occurred. Please try again later.',
            ], 500);
        }
    }
}
