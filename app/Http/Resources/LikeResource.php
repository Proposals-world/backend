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
            'user' => [
                'id' => $this->user->id,
                'first_name' => $this->user->first_name,
                'last_name' => $this->user->last_name,
                'email' => $this->user->email,
                'photos' => $this->user->photos->map(function ($photo) {
                    return [
                        'id' => $photo->id,
                        'url' => $photo->photo_url, // Assuming `url` is the field storing the photo path
                    ];
                }),
            ],
        ];
    }
}
