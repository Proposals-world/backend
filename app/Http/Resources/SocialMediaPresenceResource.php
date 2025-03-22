<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SocialMediaPresenceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $lang = $request->header('Accept-Language', 'en');

        return [
            'id' => $this->id,
            'name' => $this->{"name_$lang"} ?? $this->name_en,
        ];
    }
}