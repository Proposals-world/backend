<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EyeColorResource extends JsonResource
{
    public function toArray($request)
    {
        $lang = $request->header('Accept-Language', 'en');

        return [
            'id' => $this->id,
            'name' => $lang === 'ar' ? $this->name_ar : $this->name_en,
        ];
    }
}