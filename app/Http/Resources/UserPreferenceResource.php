<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserPreferenceResource extends JsonResource
{
    protected $lang;

    /**
     * Constructor to accept the language header.
     */
    public function __construct($resource, $lang = 'en')
    {
        parent::__construct($resource);
        $this->lang = $lang;
    }

    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        // Determine the language dynamically
        $lang = $this->lang === 'ar' ? 'ar' : 'en';
        // dd($request);
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'preferred_nationality' => $this->preferredNationality ? $this->preferredNationality->{"name_{$lang}"} : null,
            'preferred_origin' => $this->preferredOrigin ? $this->preferredOrigin->{"name_{$lang}"} : null,
            'preferred_country' => $this->preferredCountry ? $this->preferredCountry->{"name_{$lang}"} : null,
            'preferred_city' => $this->preferredCity ? $this->preferredCity->{"name_{$lang}"} : null,
            'preferred_age_min' => $this->preferred_age_min,
            'preferred_age_max' => $this->preferred_age_max,
            'preferred_educational_level' => $this->preferredEducationalLevel ? $this->preferredEducationalLevel->{"name_{$lang}"} : null,
            'preferred_specialization' => $this->preferredSpecialization ? $this->preferredSpecialization->{"name_{$lang}"} : null,
            'preferred_employment_status' => $this->preferred_employment_status,
            'preferred_job_title' => $this->preferredJobTitle ? $this->preferredJobTitle->{"name_{$lang}"} : null,
            'preferred_financial_status' => $this->preferredFinancialStatus ? $this->preferredFinancialStatus->{"name_{$lang}"} : null,
            'preferred_height' => $this->preferredHeight ? $this->preferredHeight->{"name_{$lang}"} : null,
            'preferred_weight' => $this->preferredWeight ? $this->preferredWeight->{"name_{$lang}"} : null,
            'preferred_marital_status' => $this->preferredMaritalStatus ? $this->preferredMaritalStatus->{"name_{$lang}"} : null,
            'preferred_smoking_status' => $this->preferred_smoking_status ? $this->preferred_smoking_status : null,
            'preferred_drinking_status' => $this->preferredDrinkingStatus ? $this->preferredDrinkingStatus->{"name_{$lang}"} : null,
            'preferred_sports_activity' => $this->preferredSportsActivity ? $this->preferredSportsActivity->{"name_{$lang}"} : null,
            'preferred_social_media_presence' => $this->preferredSocialMediaPresence ? $this->preferredSocialMediaPresence->{"name_{$lang}"} : null,
            'preferred_marriage_budget' => $this->preferredmarriageBudget ? $this->preferredmarriageBudget->{'budget_' . $this->lang} : null,
            'preferred_religiosity_level' => $this->preferredReligiosityLevel ? $this->preferredReligiosityLevel->{"name_{$lang}"} : null,
            'preferred_sleep_habit' => $this->preferredSleepHabit ? $this->preferredSleepHabit->{"name_{$lang}"} : null,
            'preferred_smoking_tools' => $this->smokingTools ? $this->smokingTools->map(function ($tool) use ($lang) {
                return [
                    'id' => $tool->id,
                    'name' => $tool->{"name_{$lang}"},
                ];
            }) : [],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
