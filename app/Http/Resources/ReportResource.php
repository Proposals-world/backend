<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // Get the Accept-Language header; default to English
        $lang = $request->header('Accept-Language', 'en');

        return [
            'id' => $this->id,
            'reporter' => [
                'id' => $this->reporter_id,
                'first_name' => $this->reporter->first_name,
                'last_name' => $this->reporter->last_name,
            ],
            'reported' => [
                'id' => $this->reported_id,
                'first_name' => $this->reported->first_name,
                'last_name' => $this->reported->last_name,
            ],
            // Only return the reason and other reason in the requested language
            'reason' => $lang === 'ar' ? $this->reason_ar : $this->reason_en,
            'other_reason' => $lang === 'ar' ? $this->other_reason_ar : $this->other_reason_en,
            'status' => $this->status,
            'report_count' => $this->report_count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
