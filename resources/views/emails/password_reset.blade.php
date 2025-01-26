<x-mail::message>
    # Password Reset

    Click the button below to reset your password. This link will expire in 60 minutes.
    
    @component('mail::button', ['url' => config('app.frontend_url') . '/reset-password?token=' . $token . '&email=' . urlencode($email)])
    Reset Password
    @endcomponent
    
    If you did not request a password reset, no further action is required.
    
    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
