<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GuardianOtp;
use App\Models\User;
use App\Models\UserPhoneNumberOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IsVerifiedController extends Controller
{
    public function isEmailVerified(Request $request)
    {
        // Validate email input
        $request->validate([
            'email' => 'required|email'
        ]);

        // Determine language
        $lang = $request->header('Accept-Language', 'en'); // default to English

        // Find user by email
        $user = User::where('email', $request->email)->first();

        // Messages
        $messages = [
            'en' => [
                'not_found'   => 'Email does not exist',
                'unverified'  => 'Email is not verified',
                'verified'    => 'Email is verified'
            ],
            'ar' => [
                'not_found'   => 'البريد الإلكتروني غير موجود',
                'unverified'  => 'البريد الإلكتروني غير مفعل',
                'verified'    => 'البريد الإلكتروني مفعل'
            ]
        ];

        // Case 1: No user found
        if (!$user) {
            return response()->json([
                'error'   => true,
                'message' => $messages[$lang]['not_found'] ?? $messages['en']['not_found']
            ], 404);
        }

        // Case 2: User exists but not verified
        if (is_null($user->email_verified_at)) {
            return response()->json([
                'verified' => false,
                'message'  => $messages[$lang]['unverified'] ?? $messages['en']['unverified']
            ]);
        }

        // Case 3: User exists and is verified
        return response()->json([
            'verified' => true,
            'message'  => $messages[$lang]['verified'] ?? $messages['en']['verified']
        ]);
    }
    public function isPhoneVerified(Request $request)
    {
        // Get the currently authenticated user
        $user = Auth::user();
        // dd($user);
        if (!$user) {
            return response()->json([
                'error'   => true,
                'message' => $request->header('Accept-Language') === 'ar'
                    ? 'المستخدم غير موجود'
                    : 'User not found'
            ], 404);
        }

        // Determine language
        $lang = $request->header('Accept-Language', 'en');

        // Messages
        $messages = [
            'en' => [
                'unverified' => 'Phone number is not verified',
                'verified'   => 'Phone number is verified'
            ],
            'ar' => [
                'unverified' => 'رقم الهاتف غير مفعل',
                'verified'   => 'رقم الهاتف مفعل'
            ]
        ];
        // Find latest unverified OTP that hasn't expired

        $otp = UserPhoneNumberOtp::where('user_id', $user->id)
            ->latest()
            ->first();

        // Case 1: No OTP found OR not verified
        if (!$otp || $otp->verified != 1) {
            return response()->json([
                'verified' => false,
                'message'  => $messages[$lang]['unverified'] ?? $messages['en']['unverified']
            ]);
        }

        // Case 2: Verified
        return response()->json([
            'verified' => true,
            'message'  => $messages[$lang]['verified'] ?? $messages['en']['verified']
        ]);
    }
    public function isGuardianVerified(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user()->profile;

        if (!$user) {
            return response()->json([
                'error' => true,
                'message' => $request->header('Accept-Language') === 'ar'
                    ? 'المستخدم غير موجود'
                    : 'User not found'
            ], 404);
        }

        // Determine language
        $lang = $request->header('Accept-Language', 'en');

        // Messages
        $messages = [
            'en' => [
                'not_set'    => 'Guardian contact is not set',
                'unverified' => 'Guardian contact is not verified',
                'verified'   => 'Guardian contact is verified'
            ],
            'ar' => [
                'not_set'    => 'جهة اتصال ولي الأمر غير موجودة',
                'unverified' => 'جهة اتصال ولي الأمر غير مفعل',
                'verified'   => 'جهة اتصال ولي الأمر مفعل'
            ]
        ];

        // Case 1: Check if guardian contact exists
        if (!$user->guardian_contact_encrypted) {
            return response()->json([
                'error'   => true,
                'message' => $messages[$lang]['not_set'] ?? $messages['en']['not_set']
            ]);
        }

        // Case 2: Check Guardian OTP verification
        $otp = GuardianOtp::where('user_id', $user->id)
            // ->where('expires_at', '>', now())
            ->where('verified', true)
            ->latest()
            ->first();

        if (!$otp) {
            return response()->json([
                'verified' => false,
                'message'  => $messages[$lang]['unverified'] ?? $messages['en']['unverified']
            ]);
        }

        // Case 3: Guardian contact exists and verified
        return response()->json([
            'verified' => true,
            'message'  => $messages[$lang]['verified'] ?? $messages['en']['verified']
        ]);
    }

    public function isProfileCompleted(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'error' => true,
                'message' => $request->header('Accept-Language') === 'ar'
                    ? 'المستخدم غير موجود'
                    : 'User not found'
            ], 404);
        }

        $profile = $user->profile;

        if (!$profile) {
            return response()->json([
                'completed' => false,
                'message' => $request->header('Accept-Language') === 'ar'
                    ? 'الملف الشخصي غير موجود'
                    : 'Profile not set'
            ]);
        }

        // Required fields for completion
        $requiredFields = [
            'nickname' => 'nickname',
            'bio' => 'bio_en', // or choose based on Accept-Language
            // 'avatar_url' => 'avatar_url',
            'nationality' => 'nationality_id',
            // 'language' => 'language_id',
            'origin' => 'origin_id',
            'religion' => 'religion_id',
            'religion_level' => 'religiosity_level_id',
            'country_of_residence' => 'country_of_residence_id',
            'city' => 'city_id',
            'date_of_birth' => 'date_of_birth',
            'educational_level' => 'educational_level_id',
            'specialization' => 'specialization',
            'employment_status' => 'employment_status',
            'job_title' => 'job_title_id',
            'position_level' => 'position_level_id',
            'financial_status' => 'financial_status_id',
            // 'guardian_contact' => 'guardian_contact_encrypted',
            'skin_color' => 'skin_color_id',
            'hair_color' => 'hair_color_id', //hair check on  male
            'eye_color' => 'eye_color_id',
            'smoking_status' => 'smoking_status',
            'drinking_status' => 'drinking_status_id',
            'sports_activity' => 'sports_activity_id',
            'social_media_presence' => 'social_media_presence_id',
            'religiosity_level' => 'religiosity_level_id',
            // 'marriage_budget' => 'marriage_budget_id', // check on  male
        ];

        // ✅ Add `marriage_budget_id` only if male
        if ($user->gender === 'male') {
            $requiredFields['marriage_budget'] = 'marriage_budget_id';
        }
        // fix
        // ✅ Add `guardian_contact` only if female
        if ($user->gender === 'female') {
            $requiredFields['guardian_contact'] = 'guardian_contact_encrypted';
        }
        $missingFields = [];

        foreach ($requiredFields as $field) {
            if (!isset($profile->$field) || is_null($profile->$field) || $profile->$field === '') {
                $missingFields[] = $field;
            }
        }
        // $missingFields = [];

        // ✅ Only check smoking tools if smoking_status = 0
        if ($profile->smoking_status == 1) {
            try {
                $exists = DB::table('user_smoking_tool_pivots')
                    ->where('user_profile_id', $profile->id)
                    ->exists();

                if (!$exists) {
                    $missingFields[] = 'smoking_tools';
                }
            } catch (\Exception $e) {
                // If table doesn't exist, treat as missing
                $missingFields[] = 'smoking_tools';
            }
        }
        // // Check hobbies
        // try {
        //     $exists = DB::table('user_hobbies')
        //         ->where('user_id', $profile->id)
        //         ->exists();

        //     if (!$exists) {
        //         $missingFields[] = 'hobbies';
        //     }
        // } catch (\Exception $e) {
        //     $missingFields[] = 'hobbies';
        // }

        // // Check pets
        // try {
        //     $exists = DB::table('user_pets')
        //         ->where('user_id', $profile->id)
        //         ->exists();

        //     if (!$exists) {
        //         $missingFields[] = 'pets';
        //     }
        // } catch (\Exception $e) {
        //     $missingFields[] = 'pets';
        // }
        if (count($missingFields) > 0) {
            return response()->json([
                'completed' => false,
                'missing_fields' => $missingFields,
                'message' => $request->header('Accept-Language') === 'ar'
                    ? 'الملف الشخصي غير مكتمل'
                    : 'Profile is incomplete'
            ]);
        }
        // Check photos
        try {
            $exists = DB::table('photos')
                ->where('user_id', $profile->id)
                ->exists();

            if (!$exists) {
                $missingFields[] = 'photos';
            }
        } catch (\Exception $e) {
            $missingFields[] = 'photos';
        }
        return response()->json([
            'completed' => true,
            'message' => $request->header('Accept-Language') === 'ar'
                ? 'الملف الشخصي مكتمل'
                : 'Profile is complete'
        ]);
    }
    public function allVerifications(Request $request)
    {
        // Call each method internally
        // $emailCheck    = $this->isEmailVerified($request)->getData(true);
        $phoneCheck    = $this->isPhoneVerified($request)->getData(true);
        $guardianCheck = Auth::user()->gender === 'female'
            ? $this->isGuardianVerified($request)->getData(true)
            : null;
        $profileCheck  = $this->isProfileCompleted($request)->getData(true);

        // Build the response array
        $data = [
            // 'email'   => $emailCheck,
            'phone'   => $phoneCheck,
            'profile' => $profileCheck,
        ];

        // Conditionally add guardian if user is female
        if (Auth::user()->gender === 'female') {
            $data['guardian'] = $guardianCheck;
        }

        return response()->json($data);
    }
}
