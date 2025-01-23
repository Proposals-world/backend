<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MessageSubscription;
use App\Mail\MessageSubscriptionConfirmation;
use Illuminate\Support\Facades\Mail;

class MessageSubscriptionController extends Controller
{
    /**
     * Handle the incoming subscription request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subscribe(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email|unique:messages_subscriptions,email',
        ]);

        // Create a new message subscription
        $subscription = MessageSubscription::create([
            'email' => $request->email,
        ]);

        // Send a confirmation email (optional)
        Mail::to($subscription->email)->send(new MessageSubscriptionConfirmation($subscription->email));

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Thank you for subscribing! Please check your email for confirmation.');
    }
}