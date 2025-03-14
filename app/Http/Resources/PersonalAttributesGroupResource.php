<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonalAttributesGroupResource extends JsonResource
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
            'hair_colors' => HairColorResource::collection($this->hairColors),
            'heights' => HeightResource::collection($this->heights),
            'weights' => WeightResource::collection($this->weights),
            'origins' => OriginResource::collection($this->origins),
            'marital_statuses' => MaritalStatusResource::collection($this->maritalStatuses),
            'skin_colors' => SkinColorResource::collection($this->skinColors),
            'zodiac_signs' => ZodiacSignResource::collection($this->zodiacSigns),
            'sleep_habits' => SleepHabitResource::collection($this->sleepHabits),
            'marriage_budget'=> MarriageBudgetResource::collection($this->marriageBudget),
        ];
    }
}