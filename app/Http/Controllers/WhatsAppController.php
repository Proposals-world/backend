<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InfobipService;
use Illuminate\Support\Facades\Log;

class WhatsAppController extends Controller
{
    protected InfobipService $infobipService;

    public function __construct(InfobipService $infobipService)
    {
        $this->infobipService = $infobipService;
    }

    /**
     * Send a plain WhatsApp message (within 24-hour window).
     */
    public function sendMessage(Request $request)
    {
        $data = $request->validate([
            'to'      => 'required|string',
            'message' => 'required|string',
        ]);

        Log::info('Sending plain WhatsApp message', $data);

        $result = $this->infobipService->sendWhatsAppMessage($data['to'], $data['message']);

        Log::info('Plain message result', $result);

        return response()->json($result);
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