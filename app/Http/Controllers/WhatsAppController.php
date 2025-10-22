<?php

namespace App\Http\Controllers;

use App\Models\GuardianOtp;
use Illuminate\Http\Request;
use App\Services\InfobipService;
use App\Services\SendWhatsAppMessageService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Services\WhatsAppContactService;

class WhatsAppController extends Controller
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
        $this->sessionId = config('services.whatsapp.session', 'samer'); // try to manipulate this value from env file

    }

    /**
     * Send a plain WhatsApp message (within 24-hour window).
     */
    // guardian contact verification message
    public function sendMessage(Request $request)
    {
        // $data = $request->validate([
        //     'to'      => 'nullable|string',
        //     // 'message' => 'required|string',
        // ]);
        $language = $request->header('Accept-Language', 'en');
        // dd($language);
        $user = Auth::user();
        // dd($user);
        // uncomment when paid
        $toParentNumber = $user->profile->guardian_contact_encrypted ?? null;
        if (!$toParentNumber) {
            return response()->json([
                'status'  => 'error',
                'message' => $language === 'ar'
                    ? 'لا يوجد رقم ولي أمر مرتبط بالحساب.'
                    : 'Guardian contact number is missing.'
            ], 400);
        }
        // $toParentNumber = '962798716432';
        $childPhoneNumber = $user->phone_number;
        if (!$childPhoneNumber) {
            return response()->json(['message' => 'Child phone number is not set.'], 400);
        }
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
        $this->contactService->insert([
            'sessionId'    => $this->sessionId,
            "id"       =>   $toParentNumber . "@s.whatsapp.net",
        ]);
        // $result = $this->infobipService->sendWhatsAppMessage($toParentNumber, $childPhoneNumber, $language, $otp);
        $message = "أهلا بكم، ها قد تم تسجيل طفلكم صاحب رقم الهاتف $childPhoneNumber بأول تطبيق أردني للزواج المتوافق مع عاداتنا وتقاليدنا. ويعمل هذا التطبيق بطريقة عصرية تحاكي احتياج المجتمع وتحترم قيمه.
يرجى إرسال رمز التحقق التالي من خلال التطبيق: $otp
حيث ستتم مشاركة رقم هاتفكم للتواصل بهدف زيارة العروس والتعرف على العائلة.
دامت الأفراح عامرة في بيوتكم.

Welcome! Your child with phone number $childPhoneNumber has been registered in the first Jordanian matchmaking app that respects our customs and traditions.
This app works in a modern way to meet the community's needs while respecting its values.
Please use the following OTP in the app to verify: $otp
Your phone number will be shared for communication purposes to visit the bride and meet the family.
Wishing you continuous joy and happiness.";


        if ($childPhoneNumber === $toParentNumber) {
            // dd($toParentNumber);
            return response()->json([
                'status'  => 'error',
                'message' => $language === 'ar'
                    ? 'لا يمكن أن يكون رقم هاتف الطفل وجهة اتصال ولي الأمر متطابقين.'
                    : 'Child phone number and guardian contact cannot be the same.'
            ], 400);
        }
        $result = $this->whatsapp->send($toParentNumber, $message);
        Log::info('Plain message result', $result);

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

    /**
     * Send a WhatsApp template message with parameters.
     */
    public function sendTemplateMessage(Request $request)
    {
        $data = $request->validate([
            'to'           => 'required|string',
            'templateName' => 'required|string',
            'language'     => 'sometimes|string|max:5',
            'parameters'   => 'required|array|min:1', // REQUIRED to avoid 7008!
        ]);

        Log::debug('Sending WhatsApp template', $data);

        $result = $this->infobipService->sendWhatsAppTemplate(
            $data['to'],
            $data['templateName'],
            $data['language'] ?? 'en_GB',
            $data['parameters']
        );

        Log::info('Template message result', $result);

        return response()->json($result);
    }
}
