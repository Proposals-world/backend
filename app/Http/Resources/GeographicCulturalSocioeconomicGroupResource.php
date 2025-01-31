<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GeographicCulturalSocioeconomicGroupResource extends JsonResource
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
            'countries' => CountryResource::collection($this->countries),
            'religions' => ReligionResource::collection($this->religions),
            'nationalities' => NationalityResource::collection($this->nationalities),
            'housing_statuses' => HousingStatusResource::collection($this->housingStatuses),
            'financial_statuses' => FinancialStatusResource::collection($this->financialStatuses),
        ];
    }
}