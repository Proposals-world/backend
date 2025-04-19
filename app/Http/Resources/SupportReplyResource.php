<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportReplyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'user_id'    => $this->user_id,
            'user'       => [
                'first_name' => $this->user->first_name ?? null,
                'last_name'  => $this->user->last_name ?? null,
            ],
            'message'    => $this->message ?? null,
            'created_at' => $this->created_at->format('Y/m/d h:i A'),
        ];
    }
}
