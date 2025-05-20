<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserDeletionService
{
    /**
     * Handle the account deletion process.
     */
    public function deleteUser(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
        ]);

        $user = $request->user();

        // Validate the password
        if (!Hash::check($request->current_password, $user->password)) {
            $errorMsg = $this->getErrorMessage($request, 'password');
            return $this->generateResponse($request, ['message' => __($errorMsg)], 422);
        }

        // Check if the request is from an API or Web (Blade)
        if ($request->expectsJson()) {
            // Handle API token invalidation (Sanctum/Passport)
            if (method_exists($user, 'tokens')) {
                $user->tokens()->delete();
            }
        } else {
            // Handle session-based logout for web
            if (Auth::check()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            }
        }

        // Delete the user from the database
        $user->delete();

        $statusMsg = $this->getErrorMessage($request, 'success');
        return $this->generateResponse($request, ['message' => __($statusMsg)], 200);
    }

    /**
     * Generate locale-based messages.
     */
    private function getErrorMessage(Request $request, $type)
    {
        $locale = $request->header('Accept-Language', app()->getLocale());
        $locale = in_array($locale, ['en', 'ar']) ? $locale : app()->getLocale();

        $messages = [
            'password' => [
                'en' => 'The provided password does not match our records.',
                'ar' => 'كلمة المرور التي أدخلتها غير صحيحة.',
            ],
            'success' => [
                'en' => 'Your account has been deleted.',
                'ar' => 'تم حذف حسابك بنجاح.',
            ],
        ];

        return $messages[$type][$locale] ?? $messages[$type]['en'];
    }

    /**
     * Generate the response based on request type.
     */
    private function generateResponse(Request $request, $data, $statusCode)
    {
        if ($request->expectsJson()) {
            return response()->json($data, $statusCode);
        }

        return redirect('/')->with($statusCode === 200 ? 'status' : 'errors', $data);
    }
}
