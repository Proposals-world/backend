<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserPhoneNumberRequest;
use App\Models\User;
use App\Models\UserPhoneNumberOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\InfobipService;
use App\Services\SendWhatsAppMessageService;
use App\Services\WhatsAppContactService;
use Illuminate\Support\Facades\Log;

use Throwable;

class UserPhoneNumberOtpController extends Controller
{
    protected InfobipService $infobipService;
    protected SendWhatsAppMessageService $whatsapp;
    protected WhatsAppContactService $contactService;
    protected  $sessionId;

    public function __construct(InfobipService $infobipService, SendWhatsAppMessageService $whatsapp, WhatsAppContactService $contactService)
    {
        $this->infobipService = $infobipService;
        $this->whatsapp       = $whatsapp;
        $this->contactService = $contactService;
        $this->sessionId = $contactService->getSessionId();

        // $this->sessionId = config('services.whatsapp.session', 'samer'); // try to manipulate this value from env file
        // $this->sessionId = $dbSessionId ?? config('services.whatsapp.session', 'samer');
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
        // $usernumber = '962798716432';
        $usernumber = Auth::user()->phone_number;
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
            if (!$this->sessionId) {
                return response()->json([
                    'status'  => 'error',
                    'message' => $language === 'ar'
                        ? 'الجلسة غير موجودة، لا يمكن إرسال رمز التحقق.'
                        : 'Session not found, cannot send OTP.'
                ], 400);
            }
            // 🛠 Generate new OTP
            $otp = rand(100000, 999999);
            $this->contactService->insert([
                'sessionId'    => $this->sessionId,
                "id"       =>   $usernumber . "@s.whatsapp.net",
            ]);

            UserPhoneNumberOtp::create([
                'user_id'    => $user->id,
                'code'       => $otp,
                'expires_at' => now()->addMinutes(15),
            ]);
        }

        // $result = $this->infobipService->sendWhatsAppMessagePhoneNumber($usernumber, $language, $otp);
        if ($language === 'ar') {
            $message = "تم طلب التحقق من رقم هاتفك. استخدم رمز التحقق: $otp للتحقق من الرقم.";
        } else {
            $message = "Your phone number has been requested to verify. Use the OTP: $otp to verify the number.";
        }
        // dd($message);
        $result = $this->whatsapp->send($usernumber, $message);
        Log::info('Plain message result', $result);
        // dd($this->sessionId);
        // dd($result);
        // ✅ Handle API error gracefully
        if (isset($result['error']) && $result['error'] === true) {
            return response()->json([
                'status'  => 'error',
                'message' => __('messages.otp_failed')
            ], $result['status'] ?? 500);
        }

        return response()->json([
            'status'  => 'success',
            'message' => __('messages.otp_success'),
            'result'  => $result
        ]);
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
        $oldnumber = $user->phone_number ?? null;
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
        // Check if the new phone number already exists for another user
        if (User::where('phone_number', $e164)->where('id', '!=', $user->id)->exists()) {
            return response()->json([
                'message' => $locale === 'ar'
                    ? 'رقم الهاتف مستخدم بالفعل من قبل مستخدم آخر.'
                    : 'Phone number already exists for another user.',
            ], 409);
        }
        // // Save
        $user->update([
            'country_code' => $request->input('country_code'),
            'phone_number' => $e164,
        ]);
        $sessionId = $this->contactService->getSessionId();
        if ($sessionId) {
            // dd($sessionId);
            // insert phone number into whatsapp contact table for male
            $this->contactService->insert([
                'sessionId'    => $sessionId,
                "id"       =>   $user->phone_number . "@s.whatsapp.net",
            ]);
            // remove old number from whatsapp contact table if exists
            $this->contactService->removeByNumber($oldnumber);
        }
        return response()->json([
            'message' => $locale === 'ar'
                ? 'تم تحديث رقم الهاتف بنجاح.'
                : 'Phone number updated successfully.',
        ]);
    }
}
