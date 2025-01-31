<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\FCMTrait;
use App\Models\User;

class FCMController extends Controller
{
    use FCMTrait;

    public function sendNotification(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        // Get user and their FCM token
        $user = User::findOrFail($request->user_id);
        $token = $user->fcm_token;

        if (!$token) {
            return response()->json(['error' => 'User does not have an FCM token'], 400);
        }

        // Send notification
        $response = $this->sendFCMNotification($request->title, $request->body, $token);

        return response()->json($response);
    }
}