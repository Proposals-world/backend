<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Carbon\Carbon;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users'],
        ], [
            'email.exists' => __('We can\'t find a user with that email address.')
        ]);

        // Delete any existing tokens for this email
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        // Create a new token
        $token = Str::random(64);
        
        // Store the token in the database
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        // Get the user
        $user = User::where('email', $request->email)->first();

        // Generate the reset URL
        $resetUrl = url(route('password.reset', [
            'token' => $token,
            'email' => $request->email,
        ], false));

        // Send the reset email
        try {
            Mail::to($request->email)->send(new PasswordResetMail($resetUrl, $user));
            return back()->with('status', __('We have emailed your password reset link!'));
        } catch (\Exception $e) {
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => __('Unable to send reset link. Please try again later.')]);
        }
    }
}
