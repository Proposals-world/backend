<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PasswordUpdateService
{
    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        try {
            // Set the application locale based on the header
            $locale = $this->getLocale($request);
            app()->setLocale($locale);

            // Define user-friendly and localized validation messages
            $messages = [
                'current_password.required' => $locale === 'ar' ? 'يرجى إدخال كلمة المرور الحالية.' : 'Please enter your current password.',
                'password.required' => $locale === 'ar' ? 'يرجى إدخال كلمة المرور الجديدة.' : 'Please enter your new password.',
                'password.confirmed' => $locale === 'ar' ? 'تأكيد كلمة المرور غير متطابق.' : 'Password confirmation does not match.',
                'password.min' => $locale === 'ar' ? 'يجب أن تحتوي كلمة المرور على الأقل على :min أحرف.' : 'The password must be at least :min characters.',
                'password.different' => $locale === 'ar' ? 'يجب أن تختلف كلمة المرور الجديدة عن كلمة المرور الحالية.' : 'The new password must be different from the current password.',
            ];

            // Validate the request with user-friendly messages
            $request->validate([
                'current_password' => 'required',
                'password' => [
                    'required',
                    'confirmed',
                    'min:8',
                    // Custom rule to ensure the new password is not the same as the current one
                    function ($attribute, $value, $fail) use ($request, $locale) {
                        if (Hash::check($value, $request->user()->password)) {
                            $message = $locale === 'ar'
                                ? 'كلمة المرور الجديدة لا يمكن أن تكون نفسها الحالية.'
                                : 'The new password cannot be the same as the current password.';
                            $fail($message);
                        }
                    },
                ],
            ], $messages);
        } catch (ValidationException $e) {
            // Return JSON response with localized errors (no generic message)
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        }

        $user = $request->user();

        // Check if the current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'errors' => [
                    'current_password' => [
                        $locale === 'ar' ? 'كلمة المرور الحالية غير صحيحة.' : 'The current password is incorrect.'
                    ]
                ]
            ], 422);
        }

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'message' => $locale === 'ar' ? 'تم تغيير كلمة المرور بنجاح.' : 'Your password has been successfully changed.',
        ], 200);
    }

    /**
     * Get the locale from the request or default to 'en'.
     */
    private function getLocale(Request $request)
    {
        $locale = $request->header('Accept-Language', app()->getLocale());
        return in_array($locale, ['en', 'ar']) ? $locale : 'en';
    }
}
