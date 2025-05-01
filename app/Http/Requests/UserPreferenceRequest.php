<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\DefaultRequest;


class UserPreferenceRequest extends FormRequest
{
    use DefaultRequest;
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // Base validation rules.
        $rules = [
            'preferred_nationality_id'           => 'nullable|exists:nationalities,id',
            'preferred_origin_id'                => 'nullable|exists:origins,id',
            'preferred_country_id'               => 'nullable|exists:countries,id',
            'preferred_city_id'                  => 'nullable|exists:cities,id',
            'preferred_age_min'                  => 'nullable|integer',
            'preferred_age_max'                  => 'nullable|integer',
            'preferred_educational_level_id'     => 'nullable|exists:educational_levels,id',
            'preferred_specialization_id'        => 'nullable|exists:specializations,id',
            'preferred_employment_status'        => 'nullable',
            'preferred_job_title_id'             => 'nullable|exists:job_titles,id',
            'preferred_financial_status_id'      => 'nullable|exists:financial_statuses,id',
            'preferred_height_id'                => 'nullable|exists:heights,id',
            'preferred_weight_id'                => 'nullable|exists:weights,id',
            'preferred_marital_status_id'        => 'nullable|exists:marital_statuses,id',
            'preferred_smoking_status'           => 'nullable',
            'preferred_smoking_tools'            => 'nullable|array',
            'preferred_smoking_tools.*'          => 'integer|exists:smoking_tools,id',
            'preferred_drinking_status_id'       => 'nullable|exists:drinking_statuses,id',
            'preferred_sports_activity_id'       => 'nullable|exists:sports_activities,id',
            'preferred_social_media_presence_id' => 'nullable|exists:social_media_presences,id',
            'preferred_marriage_budget_id'       => 'nullable|exists:marriage_budgets,id',
            'preferred_religiosity_level_id'     => 'nullable|exists:religiosity_levels,id',
            'preferred_religion_id'               => 'nullable|exists:religions,id',
            'preferred_sleep_habit_id'           => 'nullable|exists:sleep_habits,id',
            'preferred_pets_id' => 'array',
            'preferred_pets_id.*' => 'exists:pets,id',
            'preferred_language_id' => 'nullable|exists:languages,id',
            'preferred_skin_color_id'          => 'nullable|exists:skin_colors,id',
            'preferred_hair_color_id'          => 'nullable|exists:hair_colors,id',
            'preferred_hijab_status'           => 'nullable',
            'preferred_children_count'         => 'nullable|integer',
            'preferred_car_ownership'          => 'nullable|boolean',
            'preferred_housing_status_id' => 'nullable|exists:housing_statuses,id',
            'eye_color_id' => ['nullable', 'exists:eye_colors,id'],
            // New rules for hobbies
            'preferred_hobbies_id'                 => 'nullable|array', // New rule for hobbies
            'preferred_hobbies_id.*'               => 'nullable|exists:hobbies,id', // Each hobby should be valid
            'preferred_pets_id'                  => 'nullable|array', // New rule for pets
            'preferred_pets_id.*'                => 'nullable|exists:pets,id', // Each pet should be valid
        ];

        // If the user has a smoking status of 1 (smokes), require that smoking tools are provided.
        if ($this->input('preferred_smoking_status') == 1) {
            $rules['preferred_smoking_tools'] = [
                'nullable',
                'array',
                function ($attribute, $value, $fail) {
                    if (empty($value)) {
                        $fail('You should specify the smoking tools.');
                    }
                },
            ];
        }

        return $rules;
    }
}
