<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetOTPMail;
use App\Models\User;
use App\Models\PasswordResetOTP;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PasswordResetController extends Controller
{
    /**
     * Send a password reset OTP to the user's email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResetOTP(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $email = $request->email;

        // Generate a 6-digit OTP
        $otp = rand(100000, 999999);

        // Delete any existing OTPs for this email
        PasswordResetOTP::where('email', $email)->delete();

        // Create a new OTP record
        PasswordResetOTP::create([
            'email' => $email,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(15),
            'is_used' => false,
        ]);

        // Retrieve the user's name for the email template
        $user = User::where('email', $email)->first();

        // Send the OTP via email
        Mail::to($email)->send(new PasswordResetOTPMail($otp, $email, $user->name));

        return response()->json([
            'success' => true,
            'message' => 'A 6-digit OTP has been sent to your email.',
        ], 200);
    }

    /**
     * Verify the password reset OTP and return a reset token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyOTP(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $email = $request->email;
        $otp = $request->otp;

        // Retrieve the OTP record
        $passwordResetOTP = PasswordResetOTP::where('email', $email)
            ->where('otp', $otp)
            ->where('is_used', false)
            ->first();

        if (!$passwordResetOTP) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP.',
            ], 400);
        }

        // Check if OTP has expired
        if (Carbon::now()->greaterThan($passwordResetOTP->expires_at)) {
            // Delete the expired OTP
            $passwordResetOTP->delete();

            return response()->json([
                'success' => false,
                'message' => 'OTP has expired. Please request a new one.',
            ], 400);
        }

        // Mark OTP as used
        $passwordResetOTP->update(['is_used' => true]);

        // Generate a password reset token
        $resetToken = Str::random(60);

        // Delete any existing password reset tokens for this email
        PasswordResetToken::where('email', $email)->delete();

        // Create a new password reset token (store hashed token)
        PasswordResetToken::create([
            'email' => $email,
            'token' => Hash::make($resetToken),
            'created_at' => Carbon::now(),
        ]);

        // Return the reset token in the API response
        return response()->json([
            'success' => true,
            'message' => 'OTP verified successfully.',
            'data' => [
                'reset_token' => $resetToken,
            ],
        ], 200);
    }

    /**
     * Reset the user's password using the reset token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'reset_token' => 'required|string',
            'email' => 'required|email|exists:users,email',
            'password' => [
                'required',
                'string',
                'min:8',              // Minimum length
                'regex:/[a-z]/',      // Must contain at least one lowercase letter
                'regex:/[A-Z]/',      // Must contain at least one uppercase letter
                'regex:/[0-9]/',      // Must contain at least one digit
                'confirmed',
            ],
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one digit.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $resetToken = $request->reset_token;
        $email = $request->email;
        $newPassword = $request->password;

        // Retrieve the password reset token record by email
        $passwordReset = PasswordResetToken::where('email', $email)->first();

        if (!$passwordReset || !Hash::check($resetToken, $passwordReset->token)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid password reset token.',
            ], 400);
        }

        // Check if the token has expired (valid for 60 minutes)
        if (Carbon::parse($passwordReset->created_at)->addMinutes(60)->isPast()) {
            // Delete the expired token
            $passwordReset->delete();

            return response()->json([
                'success' => false,
                'message' => 'Password reset token has expired.',
            ], 400);
        }

        // Update the user's password
        $user = User::where('email', $email)->first();
        $user->password = Hash::make($newPassword);
        $user->save();

        // Delete the password reset token to prevent reuse
        $passwordReset->delete();

        // Optionally, send a confirmation email
        // Mail::to($user->email)->send(new PasswordResetConfirmationMail($user->name));

        return response()->json([
            'success' => true,
            'message' => 'Your password has been reset successfully.',
        ], 200);
    }
}
