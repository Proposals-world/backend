<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfessionalEducationalGroupResource extends JsonResource
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
            'specializations' => SpecializationResource::collection($this->specializations),
            'position_levels' => PositionLevelResource::collection($this->positionLevels),
            'educational_levels' => EducationalLevelResource::collection($this->educationalLevels),
            // 'marriage_budget' => MarriageBudgetResource::collection($this->marriageBudget),
        ];
    }
}