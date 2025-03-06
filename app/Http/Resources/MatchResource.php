<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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

        return [
            'id' => $this->id,
            // 'user1_name' => $this->user1 ? $this->user1->first_name : null,
            'matched_user_name' => $this->user2 ? $this->user2->first_name : null,
            'matched_user_age' => $this->user1 && $this->user1->profile ? $this->user1->profile->age : null,
            'matched_user_city' => $this->user1 && $this->user1->profile && $this->user1->profile->city
                ? ($this->user1->profile->city->{'name_' . $lang} ?? null) : null,
            'match_status' => $this->match_status,
            'contact_exchanged' => $this->contact_exchanged, // No need to convert, already a boolean
            // 'user1_photo' => $this->user1 && $this->user1->photos()->first() ? $this->user1->photos()->first()->photo_url : null,
            'matched_user_photo' => $this->user2 && $this->user2->photos()->first() ? $this->user2->photos()->first()->photo_url : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
