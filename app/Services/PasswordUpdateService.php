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
        // Determine and set locale from header (default to app locale)
        $locale = $this->getLocale($request);
        app()->setLocale($locale);

        // Define user-friendly, localized validation messages
        $messages = [
            'current_password.required' => $locale === 'ar'
                ? 'يرجى إدخال كلمة المرور الحالية.'
                : 'Please enter your current password.',

            'password.required'         => $locale === 'ar'
                ? 'يرجى إدخال كلمة المرور الجديدة.'
                : 'Please enter your new password.',

            'password.min'              => $locale === 'ar'
                ? 'يجب أن تحتوي كلمة المرور على الأقل على :min أحرف.'
                : 'The password must be at least :min characters.',

            'password.confirmed'        => $locale === 'ar'
                ? 'تأكيد كلمة المرور غير متطابق.'
                : 'Password confirmation does not match.',

            // <-- new complexity message:
            'password.regex'            => $locale === 'ar'
                ? 'يجب أن تحتوي كلمة المرور على حرف كبير واحد على الأقل، حرف صغير واحد، رقم واحد ورمز واحد.'
                : 'The password must contain at least one uppercase letter, one lowercase letter, one number and one symbol.',

            // If you also localize this key in validation.custom.phone_number.regex:
            'phone_number.regex'        => __('validation.custom.phone_number.regex'),
        ];

        try {
            // Validate with the regex rule for complexity
            $request->validate([
                'current_password' => 'required',
                'password'         => [
                    'required',
                    'string',
                    'min:8',
                    // complexity regex:
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).+$/',
                    'confirmed',
                    // ensure new ≠ old:
                    function ($attribute, $value, $fail) use ($request, $locale) {
                        if (Hash::check($value, $request->user()->password)) {
                            $fail($locale === 'ar'
                                ? 'كلمة المرور الجديدة لا يمكن أن تكون نفسها الحالية.'
                                : 'The new password cannot be the same as the current password.');
                        }
                    },
                ],
                'phone_number'     => [
                    'nullable',
                    'string',
                    'max:255',
                    'regex:/^(078|077|079)\d{7}$/',
                ],
            ], $messages);
        } catch (ValidationException $e) {
            // Return only the specific field errors, localized
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        }

        $user = $request->user();

        // Verify current password before changing
        if (! Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'errors' => [
                    'current_password' => [
                        $locale === 'ar'
                            ? 'كلمة المرور الحالية غير صحيحة.'
                            : 'The current password is incorrect.',
                    ],
                ],
            ], 422);
        }

        // Everything’s good – update!
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'message' => $locale === 'ar'
                ? 'تم تغيير كلمة المرور بنجاح.'
                : 'Your password has been successfully changed.',
        ], 200);
    }

    /**
     * Pull locale from `Accept-Language` header or fallback.
     */
    private function getLocale(Request $request): string
    {
        $locale = $request->header('Accept-Language', app()->getLocale());
        return in_array($locale, ['en', 'ar']) ? $locale : 'en';
    }
}
