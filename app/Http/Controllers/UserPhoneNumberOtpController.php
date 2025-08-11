<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserPhoneNumberRequest;
use App\Models\UserPhoneNumberOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\InfobipService;
use Illuminate\Support\Facades\Log;
use Throwable;

class UserPhoneNumberOtpController extends Controller
{
    protected InfobipService $infobipService;

    public function __construct(InfobipService $infobipService)
    {
        $this->infobipService = $infobipService;
    }
    public function index()
    {
        $user = auth()->user();

        $phone = $user->phone_number ?? '';
        $countryCode = $user->country_code ?? 'JO'; // default if needed
        $dialCode = config('countries')[$countryCode]['dial_code'] ?? '';

        // Remove leading + from phone number
        $phoneTrimmed = ltrim($phone, '+');

        // Remove dial code from start if it exists
        if (str_starts_with($phoneTrimmed, ltrim($dialCode, '+'))) {
            $phoneTrimmed = substr($phoneTrimmed, strlen(ltrim($dialCode, '+')));
        }

        return view('verify-phone-number-otp', [
            'localPhone' => $phoneTrimmed,
            'countryCode' => $countryCode,
        ]);
    }

    public function sendMessage(Request $request)
    {

        $language = $request->header('Accept-Language', 'en');
        $user = Auth::user();
        // uncomment when paid
        // $to = $user->profile->guardian_contact_encrypted ?? null;
        $usernumber = '962798716432';
        // $usernumber = Auth::user()->phone_number;
        if (!$usernumber) {
            return response()->json(['message' => 'User phone number is not set.'], 400);
        }
        // 🛠 Check if existing OTP still valid
        $existingOtp = UserPhoneNumberOtp::where('user_id', $user->id)
            ->where('expires_at', '>', now())
            ->where('verified', false)
            ->latest()
            ->first();

        if ($existingOtp) {
            $otp = $existingOtp->code;  // Use existing OTP
        } else {
            // 🛠 Generate new OTP
            $otp = rand(100000, 999999);

            UserPhoneNumberOtp::create([
                'user_id'    => $user->id,
                'code'       => $otp,
                'expires_at' => now()->addMinutes(15),
            ]);
        }

        $result = $this->infobipService->sendWhatsAppMessagePhoneNumber($usernumber, $language, $otp);

        Log::info('Plain message result', $result);

        return response()->json($result);
    }
    public function verify(Request $request)
    {
        try {
            $locale = $request->header('Accept-Language', 'en');

            $request->validate([
                'code' => 'required|string'
            ]);

            $user = auth()->user();

            if (!$user || !$user->phone_number) {
                return response()->json([
                    'message' => $locale === 'ar'
                        ? 'رقم هاتفك غير موجود في الملف الشخصي.'
                        : 'Phone number is not set in the profile.',
                ], 400);
            }

            // $formattedPhone = $this->formatJordanianPhone($user->profile->guardian_contact_encrypted);

            // 🛠 Only check the newest, latest OTP
            $record = UserPhoneNumberOtp::where('user_id', $user->id)
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
                    ? 'تم التحقق من رقم هاتفك  بنجاح.'
                    : 'Phone Number verified successfully.',
            ]);
        } catch (Throwable $e) {
            Log::error('Phone Number OTP Verify Error', ['error' => $e->getMessage()]);

            return response()->json([
                'message' => $request->header('Accept-Language') === 'ar'
                    ? 'حدث خطأ، يرجى المحاولة لاحقاً.'
                    : 'An error occurred. Please try again later.',
            ], 500);
        }
    }
    public function updatePhoneNumber(UpdateUserPhoneNumberRequest  $request)
    {
        $locale = $request->header('Accept-Language', 'en');
        $user   = auth()->user();

        // Grab the validated E.164 number
        $e164 = $request->input('_user_full_phone');

        // Prevent saving the same number again
        if ($e164 === $user->phone_number) {
            return response()->json([
                'message' => $locale === 'ar'
                    ? 'لا يمكن أن يكون رقم الهاتف الجديد هو نفسه الرقم الحالي.'
                    : 'New phone number cannot be the same as the current one.',
            ], 400);
        }

        // Save
        $user->update([
            'country_code' => $request->input('country_code'),
            'phone_number' => $e164,
        ]);
        return response()->json([
            'message' => $locale === 'ar'
                ? 'تم تحديث رقم الهاتف بنجاح.'
                : 'Phone number updated successfully.',
        ]);
    }
}
