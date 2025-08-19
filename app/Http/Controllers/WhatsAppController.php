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
    public function sendMessage(Request $request)
    {
        // $data = $request->validate([
        //     'to'      => 'nullable|string',
        //     // 'message' => 'required|string',
        // ]);
        $language = $request->header('Accept-Language', 'en');
        $user = Auth::user();
        // uncomment when paid
        $toParentNumber = $user->profile->guardian_contact_encrypted ?? null;
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
        $message = "Your child with phone number $childPhoneNumber has requested to verify their Guardian Contact. Use the OTP: $otp to verify the number.";

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
