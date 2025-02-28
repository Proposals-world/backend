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
            // Pets
            'pets' => $this->user->pets ? $this->user->pets->map(function ($pet) {
                return [
                    'id' => $pet->id,
                    'name' => $this->lang === 'ar' ? $pet->name_ar : $pet->name_en,
                ];
            }) : [],
            'smooking_tools' => $this->smokingTools->map(function ($tool) {
                return [
                    'id' => $tool->id,
                    'name' => $tool->name_en,
                ];
            }),


        ];
    }
}
