<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LikeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'liked_user' => [
                'id'         => $this->likedUser->id,
                'first_name' => $this->likedUser->first_name,
                'last_name'  => $this->likedUser->last_name,
                'email'      => $this->likedUser->email,
                'photos'     => $this->likedUser->photos->map(function ($photo) {
                    return [
                        'id'  => $photo->id,
                        'url' => $photo->photo_url, // Assuming this is the photo URL field
                    ];
                }),
            ],
        ];
    }
}
