<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LifestyleInterestsGroupResource extends JsonResource
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
            'hobbies' => HobbyResource::collection($this->hobbies),
            'pets' => PetResource::collection($this->pets),
            'sports_activities' => SportsActivityResource::collection($this->sportsActivities),
            'smoking_tools' => SmokingToolResource::collection($this->smokingTools),
            'drinking_statuses' => DrinkingStatusResource::collection($this->drinkingStatuses),
        ];
    }
}