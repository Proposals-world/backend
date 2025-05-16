<?php
// app/Http/Controllers/WhatsAppController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InfobipService;

class WhatsAppController extends Controller
{
    public function __construct(protected InfobipService $infobipService) {}

    public function sendMessage(Request $request)
    {
        $data = $request->validate([
            'to'      => 'required|string',
            'message' => 'required|string',
        ]);

        $result = $this->infobipService
            ->sendWhatsAppMessage($data['to'], $data['message']);

        return response()->json($result);
    }
}
