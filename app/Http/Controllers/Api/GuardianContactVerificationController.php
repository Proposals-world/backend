<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\GuardianOtp;
use App\Services\GuardianContactVerificationService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateGuardianContactRequest;
use App\Services\WhatsAppContactService;
use Throwable;

class GuardianContactVerificationController extends Controller
{
    protected WhatsAppContactService $contactService;
    protected  $sessionId;


    public function __construct(WhatsAppContactService $contactService)
    {

        $this->contactService = $contactService;
        $this->sessionId = $contactService->getSessionId();

        // $this->sessionId = config('services.whatsapp.session', 'samer'); // try to manipulate this value from env file
        // $this->sessionId = $dbSessionId ?? config('services.whatsapp.session', 'samer');
    }
    // this old no user for the vrefy send use \app\Http\Controllers\WhatsAppController.php
    public function index()
    {
        $user = auth()->user();
        $profile = $user->profile; // Assuming relation user->profile exists

        $phone = $profile->guardian_contact_encrypted ?? '';
        $countryCode = $user->country_code ?? 'JO'; // or get from profile if available
        $dialCode = config('countries')[$countryCode]['dial_code'] ?? '';

        // Remove leading + from phone number
        $phoneTrimmed = ltrim($phone, '+');

        // Remove dial code from start if it exists
        if (str_starts_with($phoneTrimmed, ltrim($dialCode, '+'))) {
            $phoneTrimmed = substr($phoneTrimmed, strlen(ltrim($dialCode, '+')));
        }

        return view('verify-guardian-otp', [
            'localPhone' => $phoneTrimmed,
            'countryCode' => $countryCode,
        ]);
    }

    // fix it edit to take the last send or resent the same code
    public function send(Request $request, GuardianContactVerificationService $service)
    {
        try {
            $locale = $request->header('Accept-Language', 'en');
            $user = auth()->user();

            if (!$user || !$user->profile || !$user->profile->guardian_contact_encrypted) {
                return response()->json([
                    'message' => $locale === 'ar'
                        ? 'رقم ولية الأمر غير موجود في الملف الشخصي.'
                        : 'Guardian phone is not set in the profile.',
                ], 400);
            }
            if ($user->profile->guardian_contact_encrypted === $user->phone_number) {
                return response()->json([
                    'message' => $locale === 'ar'
                        ? 'رقم ولية الأمر لا يمكن أن يكون نفس رقم المستخدم.'
                        : 'Guardian phone cannot be the same as the user phone.',
                ], 400);
            }

            $formattedPhone = ($user->profile->guardian_contact_encrypted);

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

            // $formattedPhone = $this->formatJordanianPhone($user->profile->guardian_contact_encrypted);

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

    // private function formatJordanianPhone($phone): string
    // {
    //     $phone = preg_replace('/[^0-9]/', '', $phone); // Keep digits only

    //     if (str_starts_with($phone, '0')) {
    //         $phone = substr($phone, 1); // Remove leading 0
    //     }

    //     if (!str_starts_with($phone, '962')) {
    //         $phone = '962' . $phone;
    //     }

    //     return '+' . $phone;
    // }




    public function updateGuardianContact(UpdateGuardianContactRequest $request)
    {
        $locale = $request->header('Accept-Language', 'en');
        $user   = auth()->user();
        $oldContact = $user->profile->guardian_contact_encrypted ?? null;
        // Grab the validated E.164 number
        $e164 = $request->input('_guardian_full');
        if ($oldContact === $e164) {
            return response()->json([
                'message' => $locale === 'ar'
                    ? 'رقم ولية الأمر هو نفسه الرقم الحالي.'
                    : 'Guardian contact is already the same as the current one.',
            ], 400);
        }
        // Prevent saving user’s own number
        if ($e164 === $user->phone_number) {
            return response()->json([
                'message' => $locale === 'ar'
                    ? 'رقم ولية الأمر لا يمكن أن يكون نفس رقم المستخدم.'
                    : 'Guardian contact cannot be the same as the user phone.',
            ], 400);
        }

        // $whatsappService = app(WhatsAppContactService::class);
        // $whatsappService->removeByNumber($oldContact);
        // Save
        $user->profile()->update([
            'country_code' => $request->input('country_code'),
            'guardian_contact_encrypted' => $e164,
        ]);
        // add contact to whatsapp db
        $this->contactService->insert([
            'sessionId'    => $this->sessionId,
            "id"       =>   $e164 . "@s.whatsapp.net",
        ]);
        // dd($oldContact);
        $this->contactService->removeByNumber($oldContact);
        return response()->json([
            'message' => $locale === 'ar'
                ? 'تم تحديث رقم ولي الأمر بنجاح.'
                : 'Guardian contact updated successfully.',
        ]);
    }
    public function validateGuardianContact(UpdateGuardianContactRequest $request)
    {
        $locale = $request->header('Accept-Language', 'en');
        $e164 = $request->input('_guardian_full');
        $user   = auth()->user();
        // Prevent saving user’s own number
        if ($e164 === $user->phone_number) {
            return response()->json([
                'message' => $locale === 'ar'
                    ? 'رقم ولية الأمر لا يمكن أن يكون نفس رقم المستخدم.'
                    : 'Guardian contact cannot be the same as the user phone.',
            ], 400);
        }
        // The request has already been validated by UpdateGuardianContactRequest
        // Just return a success message if it passes.
        return response()->json([
            'message' => $locale === 'ar'
                ? 'رقم ولي الأمر صالح.'
                : 'Guardian contact is valid.',
        ]);
    }
}
