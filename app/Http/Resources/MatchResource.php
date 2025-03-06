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
            'user1_name' => $this->user1 ? $this->user1->first_name : null,
            'user2_name' => $this->user2 ? $this->user2->first_name : null,
            'match_status' => $this->match_status,
            'contact_exchanged' =>  $this->contact_exchanged, // Convert to boolean
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
