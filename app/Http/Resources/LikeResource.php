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
                'id'         => $this->User->id,
                'first_name' => $this->User->first_name,
                'last_name'  => $this->User->last_name,
                'email'      => $this->User->email,
                'photos'     => $this->User->photos->map(function ($photo) {
                    return [
                        'id'  => $photo->id,
                        'url' => $photo->photo_url, // Assuming this is the photo URL field
                        'is_main' => $photo->is_main, // Assuming this is the photo URL field
                    ];
                }),
            ],
        ];
    }
}
