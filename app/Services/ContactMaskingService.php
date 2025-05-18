<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserMatch;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Request;

class ContactMaskingService
{
    public function maskPhone(?string $phone): string
    {
        if (!$phone || strlen($phone) < 8) {
            return '07******';
        }

        return substr($phone, 0, 2) . str_repeat('*', strlen($phone) - 4) . substr($phone, -2);
    }

    public function maskEmail(?string $email): string
    {
        if (!$email || !str_contains($email, '@')) {
            return '***@***.com';
        }

        [$name, $domain] = explode('@', $email);
        $maskedName = substr($name, 0, 1) . str_repeat('*', max(1, strlen($name) - 2)) . substr($name, -1);
        $domainParts = explode('.', $domain);
        $maskedDomain = str_repeat('*', strlen($domainParts[0])) . '.' . end($domainParts);

        return $maskedName . '@' . $maskedDomain;
    }

    public function maskGuardianContact(?string $contact): string
    {
        return $contact ? '**********' : 'N/A';
    }

    public function getContactInfo(int $authUserId, int $matchedUserId): array
    {
        $match = UserMatch::where(function ($q) use ($authUserId, $matchedUserId) {
            $q->where('user1_id', $authUserId)->where('user2_id', $matchedUserId);
        })->orWhere(function ($q) use ($authUserId, $matchedUserId) {
            $q->where('user1_id', $matchedUserId)->where('user2_id', $authUserId);
        })->first();

        if (! $match) {
            return ['error' => 'Match not found.'];
        }

        // Fetch both user and profile
        $user    = User::select('gender', 'phone_number')->find($matchedUserId);
        $profile = UserProfile::select('guardian_contact_encrypted')->find($matchedUserId);

        if (! $user) {
            return ['error' => 'User not found.'];
        }

        // Mark as exchanged if not already
        if (! $match->contact_exchanged) {
            $match->update(['contact_exchanged' => true]);
        }

        // Decide which contact to return
        $contact = 'N/A';
        if (strtolower($user->gender) === 'female') {
            $contact = $profile->guardian_contact_encrypted ?? 'N/A';
        } else {
            $contact = $user->phone_number ?? 'N/A';
        }

        // Return under the same key your front-end expects
        return ['contact' => $contact];
    }
}
