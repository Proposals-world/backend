<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DynamicDataResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'religions' => ReligionResource::collection($this->religions),
            'specializations' => SpecializationResource::collection($this->specializations),
            'hobbies' => HobbyResource::collection($this->hobbies),
            'pets' => PetResource::collection($this->pets),
            'marriage_budgets' => MarriageBudgetResource::collection($this->marriageBudgets),
            'origins' => OriginResource::collection($this->origins),
        ];
    }
}