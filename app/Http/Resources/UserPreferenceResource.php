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
        // dd($this->id ?? null);
        // dd($this->smokingTools()->get());

        return [
            'id' => $this->id ?? null,
            'user_id' => $this->user_id ?? null,
            'preferred_nationality' => $this->preferredNationality ? $this->preferredNationality->{"name_{$lang}"} : null,
            'preferred_language_id' => $this->language ? $this->language->{"name_{$lang}"} : null, // Fixed here
            'preferred_origin' => $this->preferredOrigin ? $this->preferredOrigin->{"name_{$lang}"} : null,
            'preferred_country' => $this->preferredCountry ? $this->preferredCountry->{"name_{$lang}"} : null,
            'preferred_city' => $this->preferredCity ? $this->preferredCity->{"name_{$lang}"} : null,
            'preferred_age_min' => $this->preferred_age_min,
            'preferred_age_max' => $this->preferred_age_max,
            'preferred_educational_level' => $this->preferredEducationalLevel ? $this->preferredEducationalLevel->{"name_{$lang}"} : null,
            'preferred_specialization' => $this->preferredSpecialization ? $this->preferredSpecialization->{"name_{$lang}"} : null,
            'preferred_position_level' => $this->preferredPositionLevel ? $this->preferredPositionLevel->{"name_{$lang}"} : null,
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
            'preferred_religion' => $this->preferredReligion ? $this->preferredReligion->{"name_{$lang}"} : null,
            'preferred_religiosity_level' => $this->preferredReligiosityLevel ? $this->preferredReligiosityLevel->{"name_{$lang}"} : null,
            'preferred_sleep_habit' => $this->preferredSleepHabit ? $this->preferredSleepHabit->{"name_{$lang}"} : null,

            'preferred_skin_color' => $this->preferredSkinColor ? $this->preferredSkinColor->{"name_{$lang}"} : null,
            'preferred_hair_color' => $this->preferredHairColor ? $this->preferredHairColor->{"name_{$lang}"} : null,
            'preferred_hijab_status' => $this->preferred_hijab_status,
            'preferred_children_count' => $this->preferred_children_count,
            'preferred_car_ownership' => $this->preferred_car_ownership,
            'preferred_housing_status' => $this->preferredHousingStatus ? $this->preferredHousingStatus->{"name_{$lang}"} : null,
            'preferred_smoking_tools' => $this->smokingTools ? $this->smokingTools->map(function ($tool) use ($lang) {
                return [
                    'id' => $tool->id,
                    'name' => $tool->{"name_{$lang}"},
                ];
            }) : [],
            'preferred_hobbies' => $this->hobbies ? $this->hobbies->map(function ($hobby) use ($lang) {
                return [
                    'id' => $hobby->id,
                    'name' => $hobby->{"name_{$lang}"},
                ];
            }) : [],

            // Preferred Pets
            'preferred_pets' => $this->pets ? $this->pets->map(function ($pet) use ($lang) {
                return [
                    'id' => $pet->id,
                    'name' => $pet->{"name_{$lang}"},
                ];
            }) : [],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
