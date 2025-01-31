<?php

namespace App\Http\Controllers;

use App\Services\FCMService;
use Illuminate\Http\Request;

class FCMController extends Controller
{
    public function sendNotification(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'token' => 'required|string',
        ]);

        $response = FCMService::sendNotification($request->title, $request->body, $request->token);

        return response()->json($response);
    }
}