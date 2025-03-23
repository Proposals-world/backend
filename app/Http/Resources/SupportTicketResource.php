<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportTicketResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $lang = $request->header('Accept-Language', 'en');

        return [
            'id'          => $this->id,
            'subject'     => $this->{"subject_{$lang}"} ?? null,
            'description' => $this->{"description_{$lang}"} ?? null,
            'status'      => $this->status,
            'created_at'  => $this->created_at->format('Y/m/d h:i A'),
            'updated_at'  => $this->updated_at->format('Y/m/d h:i A'),
            'replies'     => SupportReplyResource::collection($this->whenLoaded('replies')),
        ];
    }
}
