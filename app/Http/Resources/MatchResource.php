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

        // Identify the matched user dynamically
        $authUserId = Auth::id();
        $matchedUser = $this->user1_id === $authUserId ? $this->user2 : $this->user1;

        // Handle phone number visibility
        $phoneNumber = null;
        if ($matchedUser) {
            if ($this->contact_exchanged) {
                // Show full phone number if contact is exchanged
                $phoneNumber = $matchedUser->phone_number;
            } else {
                // Mask the phone number, ensuring it starts with "07"
                $phoneNumber = $this->maskPhoneNumber($matchedUser->phone_number);
            }
        }
        // dd($matchedUser->photos()->where('is_main', 1)->first());
        return [
            'id' => $this->id,
            'matched_user_id' => $matchedUser ? $matchedUser->id : null,
            'matched_user_name' => $matchedUser ? $matchedUser->first_name : null,
            'matched_user_age' => $matchedUser && $matchedUser->profile ? $matchedUser->profile->age : null,
            'matched_user_city' => $matchedUser && $matchedUser->profile && $matchedUser->profile->city
                ? ($matchedUser->profile->city->{'name_' . $lang} ?? null) : null,
            // 'match_status' => $this->match_status,
            'contact_exchanged' => $this->contact_exchanged,
            'matched_user_phone' => $phoneNumber,
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
}
