<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilteredUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // goo to models and try without joins
        return [
            'id' => $this->id,
            'user' => new UserProfileResource($this->whenLoaded('user')), // Load related user details
            'nationality' => $this->nationality_id,
            'origin' => $this->origin_id,
            'religion' => $this->religion_id,
            'religiosity_level' => $this->religiosity_level_id,
            'country_of_residence' => $this->country_of_residence_id,
            'city' => $this->city_id,
            'age' => $this->age,
            'educational_level' => $this->educational_level_id,
            'specialization' => $this->specialization_id,
            'employment_status' => $this->employment_status,
            'job_title' => $this->job_title_id,
            'financial_status' => $this->financial_status_id,
            'height' => $this->height_id,
            'weight' => $this->weight_id,
            'marital_status' => $this->marital_status_id,
            'children' => $this->children,
            'smoking_status' => $this->smoking_status,
            'drinking_status' => $this->drinking_status_id,
            'sports_activity' => $this->sports_activity_id,
            'social_media_presence' => $this->social_media_presence_id,
            'sleep_habit' => $this->sleep_habit_id,
            'marriage_budget' => $this->marriage_budget_id,
            'created_at' => $this->created_at,
        ];
    }
}
