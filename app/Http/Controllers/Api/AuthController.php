<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\OTPVerificationMail;
use App\Models\User;
use App\Models\VerificationToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Str; 
class AuthController extends Controller
{
    /**
     * Register a new user and send OTP for verification.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'nullable|string|unique:users,phone_number',
            'password' => 'required|string|min:6|confirmed',
            'gender' => 'required|in:male,female',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'role_id' => 2,
        ]);

        // Generate OTP
        $otp = rand(100000, 999999);

        // Delete existing OTPs for this user
        VerificationToken::where('user_id', $user->id)->where('token_type', 'otp_verification')->delete();

        // Create verification token
        VerificationToken::create([
            'user_id' => $user->id,
            'token' => $otp,
            'token_type' => 'otp_verification',
            'expires_at' => Carbon::now()->addHour(),
            'is_used' => false,
        ]);

        // Send OTP via email
        Mail::to($user->email)->send(new OTPVerificationMail($user, $otp));

        return response()->json([
            'success' => true,
            'message' => 'Registration successful. Please verify your email using the OTP sent.',
        ], 201);
    }

    /**
     * Verify OTP for user registration.
     */
    public function verifyOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        $verificationToken = VerificationToken::where('user_id', $user->id)
            ->where('token_type', 'otp_verification')
            ->where('is_used', false)
            ->latest()
            ->first();

        if (!$verificationToken) {
            return response()->json([
                'success' => false,
                'message' => 'No OTP found. Please request a new one.',
            ], 404);
        }

        if (Carbon::now()->greaterThan($verificationToken->expires_at)) {
            return response()->json([
                'success' => false,
                'message' => 'OTP has expired. Please request a new one.',
            ], 400);
        }

        if ($verificationToken->token !== $request->otp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP.',
            ], 400);
        }

        $verificationToken->update(['is_used' => true]);

        $user->email_verified_at = Carbon::now();
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'OTP verified successfully.',
        ], 200);
    }

    /**
     * Login user.
     */
    public function login(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }
    
        // Attempt to authenticate
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials.',
            ], 401);
        }
    
        $user = Auth::user();
    
        // Check if the user's role is authorized (e.g., role_id = 2 for this example)
        if ($user->role_id !== 2) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized role.',
            ], 403);
        }
    
        // Check if the user's email is verified
        if (!$user->email_verified_at) {
            return response()->json([
                'success' => false,
                'message' => 'Your email is not verified. Please verify your email before logging in.',
            ], 403);
        }
    
        // If the email is verified, log the user in and issue an access and refresh token
        $accessToken = $user->createToken('auth_token')->plainTextToken;
    
        // Generate and store a refresh token
        $refreshToken = Str::random(60);
        DB::table('refresh_tokens')->insert([
            'user_id' => $user->id,
            'token' => $refreshToken,
            'expires_at' => Carbon::now()->addDays(30),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'data' => [
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken,
                'token_type' => 'Bearer',
            ],
        ], 200);
    }
    

    /**
     * Refresh the access token.
     */
    public function refreshToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'refresh_token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        $refreshToken = $request->refresh_token;
        $record = DB::table('refresh_tokens')->where('token', $refreshToken)->first();

        if (!$record || Carbon::now()->greaterThan($record->expires_at)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired refresh token.',
            ], 401);
        }

        $user = User::find($record->user_id);
        $newAccessToken = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Access token refreshed.',
            'data' => [
                'access_token' => $newAccessToken,
            ],
        ], 200);
    }
    public function resendVerificationLink(Request $request)
{
    // Validate the email
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|exists:users,email',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'errors' => $validator->errors(),
        ], 422);
    }

    // Retrieve the user
    $user = User::where('email', $request->email)->first();

    // Check if the user is already verified
    if ($user->email_verified_at) {
        return response()->json([
            'success' => false,
            'message' => 'This email is already verified.',
        ], 400);
    }

    // Generate a new OTP
    $otp = rand(100000, 999999);

    // Delete any previous OTP for the user
    VerificationToken::where('user_id', $user->id)->delete();

    // Create a new verification token
    VerificationToken::create([
        'user_id' => $user->id,
        'token' => $otp,
        'token_type' => 'otp_verification',
        'expires_at' => Carbon::now()->addHour(),
        'is_used' => false,
    ]);

    // Send the OTP via email
    Mail::to($user->email)->send(new OTPVerificationMail($user, $otp));

    return response()->json([
        'success' => true,
        'message' => 'A new verification link has been sent to your email.',
    ], 200);
}
}
