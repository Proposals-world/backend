<?php

namespace App\Services;

use App\Mail\UserSuspendedMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserSuspensionService
{
    public function suspendUser(User $user): void
    {
        // Suspend the user
        $user->update(['status' => 'suspended']);

        // Send suspension email
        Mail::to($user->email)->send(new UserSuspendedMail($user));
    }
}
