<?php
// app/Http/Controllers/WhatsAppController.php - CORRECTED VERSION

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InfobipService;
use Illuminate\Support\Facades\Log;

class WhatsAppController extends Controller
{
    public function __construct(protected InfobipService $infobipService) {}

    public function sendMessage(Request $request)
    {
        $data = $request->validate([
            'to'      => 'required|string',
            'message' => 'required|string',
        ]);
        
        // Log before sending
        Log::info('Attempting to send WhatsApp message', [
            'to' => $data['to'],
            'message' => $data['message'],
            'sender' => env('INFOBIP_SENDER')
        ]);
        
        $result = $this->infobipService
            ->sendWhatsAppMessage($data['to'], $data['message']);
        
        // Log the result
        Log::info('WhatsApp send result', [
            'result' => $result,
            'messageId' => $result['messageId'] ?? 'none'
        ]);
        
        return response()->json($result);
    }

    public function sendTemplateMessage(Request $request)
    {
        Log::debug('Template Message Request', $request->all());
    
        $data = $request->validate([
            'to'           => 'required|string',
            'templateName'     => 'required|string',
            'language'     => 'sometimes|string|max:5',
            'parameters'   => 'sometimes|array',
        ]);
    
        // Set default values after validation
        $language = $data['language'] ?? 'en_GB';
        $parameters = $data['parameters'] ?? [];
        
        $result = $this->infobipService->sendWhatsAppTemplate(
            $data['to'],
            $data['templateName'],
            $language,
            $parameters
        );
    
        return response()->json($result);
    }
}