<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilteredUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    protected $lang;

    public function toArray(Request $request): array
    {
        $this->lang = $request->header('Accept-Language', 'en');

        // Return the user details along with their profile data and photos
        return [
            'id' => $this->user->id, // Get user id from the related user model
            'first_name' => $this->user->first_name, // User's first name
            'last_name' => $this->user->last_name, // User's last name
            'email' => $this->user->email, // User's email
            'phone_number' => $this->user->phone_number, // User's phone number
            'gender' => $this->user->gender, // User's gender
            'profile_status' => $this->profile_status, // Profile status from user profile
            'status' => $this->user->status, // Status from the user model
            'last_active' => $this->user->last_active, // Last active date from the user model
            // Photos
            'photos' => $this->user->photos->map(function ($photo) {
                return [
                    'photo_url' => config('app.url') . $photo->photo_url,
                    'caption' => $this->lang === 'ar' ? $photo->caption_ar : $photo->caption_en,
                    'is_main' => $photo->is_main,
                ];
            }),

        ];
    }
}
