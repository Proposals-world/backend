<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MarriageBudgetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // Get the language from the request header, defaulting to English.
        $lang = $request->header('Accept-Language', 'en');

        return [
            'id'       => $this->id,
            'budget'   => $lang === 'ar' ? $this->budget_ar : $this->budget_en,
        ];
    }
}