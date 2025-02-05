<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReligiousLevelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        // Get the Accept-Language header; default to English
        $lang = $request->header('Accept-Language', 'en');

        return [
            'id'   => $this->id,
            'name' => $lang === 'ar' ? $this->name_ar : $this->name_en,
        ];
    }
}