<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SleepHabitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // Determine the language from the request header, defaulting to English.
        $lang = $request->header('Accept-Language', 'en');

        return [
            'id'   => $this->id,
            'name' => $lang === 'ar' ? $this->name_ar : $this->name_en,
        ];
    }
}