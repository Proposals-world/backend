<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class MatchResource extends JsonResource
{
    protected $lang;

    /**
     * Constructor to accept the language header.
     */
    public function __construct($resource, $lang = 'en')
    {
        parent::__construct($resource);
        $this->lang = $lang;
    }

    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        $lang = $this->lang === 'ar' ? 'ar' : 'en';

        $authUserId = Auth::id();
        $matchedUser = $this->user1_id === $authUserId ? $this->user2 : $this->user1;

        $phoneNumber = null;
        $email = null;

        if ($matchedUser) {
            if ($this->contact_exchanged) {
                $phoneNumber = $matchedUser->phone_number;
                $email = $matchedUser->email;
            } else {
                $phoneNumber = $this->maskPhoneNumber($matchedUser->phone_number);
                $email = $this->maskEmail($matchedUser->email);
            }
        }

        return [
            'id' => $this->id,
            'matched_user_id' => $matchedUser ? $matchedUser->id : null,
            'matched_user_nickname' => $matchedUser ? $matchedUser->profile->nickname : null,
            'matched_user_name' => $matchedUser ? $matchedUser->first_name : null,
            'matched_user_age' => $matchedUser && $matchedUser->profile ? $matchedUser->profile->age : null,
            'matched_user_city' => $matchedUser && $matchedUser->profile && $matchedUser->profile->city
                ? ($matchedUser->profile->city->{'name_' . $lang} ?? null) : null,
            'contact_exchanged' => $this->contact_exchanged,
            'matched_user_phone' => $phoneNumber,
            'matched_user_email' => $email,
            'matched_user_photo' => $matchedUser && $matchedUser->photos()->where('is_main', 1)->first()
                ? $matchedUser->photos()->where('is_main', 1)->first()->photo_url
                : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    /**
     * Mask the phone number while keeping the first two digits (07).
     */
    private function maskPhoneNumber($phone)
    {
        if (!$phone || strlen($phone) < 8) {
            return '07******'; // Fallback in case phone number is too short
        }

        return substr($phone, 0, 2) . str_repeat('*', strlen($phone) - 4) . substr($phone, -2);
    }

    private function maskEmail($email)
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
}
