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
use Carbon\Carbon;
use Validator;

class AuthController extends Controller
{
    /**
     * Register a new user and send OTP for verification.
     */
    public function register(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
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
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'role_id' => 2,
            'status' => 'active',
        ]);
    
        // Generate OTP
        $otp = rand(100000, 999999);
    
        // Delete existing OTPs for this user
        VerificationToken::where('user_id', $user->id)
            ->where('token_type', 'otp_verification')
            ->delete();
    
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
        // Validate incoming request
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

        // Retrieve user
        $user = User::where('email', $request->email)->first();

        // Retrieve the latest unused OTP
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

        // Check if OTP is expired
        if (Carbon::now()->greaterThan($verificationToken->expires_at)) {
            return response()->json([
                'success' => false,
                'message' => 'OTP has expired. Please request a new one.',
            ], 400);
        }

        // Check if OTP matches
        if ($verificationToken->token !== $request->otp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP.',
            ], 400);
        }

        // Mark OTP as used
        $verificationToken->update(['is_used' => true]);

        // Mark email as verified
        $user->email_verified_at = Carbon::now();
        $user->save();
        if (!$user->profile) {
            $user->profile()->create([
                'id' => $user->id,
                'bio_en' => '',
                'bio_ar' => '',
                'avatar_url' => null,
                'id_number' => null,
                'criminal_record_url' => null,
                'id_verification_status' => 'unverified',
                'criminal_record_status' => 'unverified',
                'nationality_id' => null,
                'origin_id' => null,
                'religion_id' => null,
                'country_of_residence_id' => null,
                'city_id' => null,
                'date_of_birth' => null,
                'age' => null,
                'zodiac_sign_id' => null,
                'educational_level_id' => null,
                'specialization_id' => null,
                'employment_status' => false,
                'job_title_id' => null,
                'sector_id' => null,
                'position_level_id' => null,
                'financial_status_id' => null,
                'housing_id' => null,
                'car_ownership' => null,
                'height_id' => null,
                'weight_id' => null,
                'health_issues_en' => null,
                'health_issues_ar' => null,
                'marital_status_id' => null,
                'children' => null,
                'skin_color_id' => null,
                'hair_color_id' => null,
                'hijab_status' => null,
                'smoking_status' => null,
                'drinking_status_id' => null,
                'sports_activity_id' => null,
                'social_media_presence_id' => null,
                'guardian_contact_encrypted' => null,
                'marriage_budget_id' => null,
                'sleep_habit_id' => null,
                'religiosity_level_id' => null,

            ]);
        }
     $token = $user->createToken('API Token')->plainTextToken;
        return response()->json([
            'success' => true,
            'message' => 'OTP verified successfully.',
            'access_token'   => $token,
            'first_time_login' => True,
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

        $user = User::where('email', $request->email)->first();
        if (!$user || $user->status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'Your account is not active. If you think this is an issue, please contact support.',
            ], 403);
        }

        // Attempt to authenticate
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials.',
            ], 401);
        }

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

        // Issue an access token
        $accessToken = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'data' => [
            'access_token' => $accessToken,
            'token_type' => 'Bearer',
            ],
        ], 200);
        }

    /**
     * Resend OTP verification link.
     */
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
        VerificationToken::where('user_id', $user->id)
            ->where('token_type', 'otp_verification')
            ->delete();

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
            'message' => 'A new verification OTP has been sent to your email.',
        ], 200);
    }

    /**
     * Get authenticated user details.
     */
    public function me(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'User details retrieved successfully.',
            'data' => $request->user(), // Authenticated user
        ], 200);
    }

    /**
     * Logout user (Revoke the access token).
     */
    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully.',
        ], 200);
    }
}