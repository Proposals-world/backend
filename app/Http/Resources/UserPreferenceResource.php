<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserPreferenceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        // dd($request);
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'preferred_nationality' => $this->preferredNationality ? $this->preferredNationality->name_en : null,
            'preferred_origin' => $this->preferredOrigin ? $this->preferredOrigin->name_en : null,
            'preferred_country' => $this->preferredCountry ? $this->preferredCountry->name_en : null,
            'preferred_city' => $this->preferredCity ? $this->preferredCity->name_en : null,
            'preferred_age_min' => $this->preferred_age_min,
            'preferred_age_max' => $this->preferred_age_max,
            'preferred_educational_level' => $this->preferredEducationalLevel ? $this->preferredEducationalLevel->name_en : null,
            'preferred_specialization' => $this->preferredSpecialization ? $this->preferredSpecialization->name_en : null,
            'preferred_employment_status' => $this->preferred_employment_status,
            'preferred_job_title' => $this->preferredJobTitle ? $this->preferredJobTitle->name_en : null,
            'preferred_financial_status' => $this->preferredFinancialStatus ? $this->preferredFinancialStatus->name_en : null,
            'preferred_height' => $this->preferredHeight ? $this->preferredHeight->name_en : null,
            'preferred_weight' => $this->preferredWeight ? $this->preferredWeight->name_en : null,
            'preferred_marital_status' => $this->preferredMaritalStatus ? $this->preferredMaritalStatus->name_en : null,
            'preferred_smoking_status' => $this->preferred_smoking_status ? $this->preferred_smoking_status : null,
            'preferred_drinking_status' => $this->preferredDrinkingStatus ? $this->preferredDrinkingStatus->name_en : null,
            'preferred_sports_activity' => $this->preferredSportsActivity ? $this->preferredSportsActivity->name_en : null,
            'preferred_social_media_presence' => $this->preferredSocialMediaPresence ? $this->preferredSocialMediaPresence->name_en : null,
            'marriage_budget' => $this->marriageBudget ? $this->marriageBudget->budget : null,
            'must_have_criteria_en' => explode(',', $this->must_have_criteria_en),
            'must_have_criteria_ar' => explode(',', $this->must_have_criteria_ar),
            'extra_features_en' => explode(',', $this->extra_features_en),
            'extra_features_ar' => explode(',', $this->extra_features_ar),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
