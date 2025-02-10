<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPreferenceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Change this if you need additional authorization logic.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // Base validation rules.
        $rules = [
            'preferred_nationality_id'           => 'required|exists:nationalities,id',
            'preferred_origin_id'                => 'required|exists:origins,id',
            'preferred_country_id'               => 'required|exists:countries,id',
            'preferred_city_id'                  => 'required|exists:cities,id',
            'preferred_age_min'                  => 'required|integer',
            'preferred_age_max'                  => 'required|integer',
            'preferred_educational_level_id'     => 'required|exists:educational_levels,id',
            'preferred_specialization_id'        => 'required|exists:specializations,id',
            'preferred_employment_status'        => 'required|boolean',
            'preferred_job_title_id'             => 'required|exists:job_titles,id',
            'preferred_financial_status_id'      => 'required|exists:financial_statuses,id',
            'preferred_height_id'                => 'required|exists:heights,id',
            'preferred_weight_id'                => 'required|exists:weights,id',
            'preferred_marital_status_id'        => 'required|exists:marital_statuses,id',
            'preferred_smoking_status'           => 'required|boolean',
            'preferred_smoking_tools'            => 'nullable|array',
            'preferred_smoking_tools.*'          => 'integer|exists:smoking_tools,id',
            'preferred_drinking_status_id'       => 'required|exists:drinking_statuses,id',
            'preferred_sports_activity_id'       => 'required|exists:sports_activities,id',
            'preferred_social_media_presence_id' => 'required|exists:social_media_presences,id',
            'preferred_marriage_budget_id'       => 'required|exists:marriage_budgets,id',
            'preferred_religiosity_level_id'     => 'required|exists:religiosity_levels,id',
            'preferred_sleep_habit_id'           => 'required|exists:sleep_habits,id',
            
        ];

        // If the user has a smoking status of 1 (smokes), require that smoking tools are provided.
        if ($this->input('preferred_smoking_status') == 1) {
            $rules['preferred_smoking_tools'] = [
                'required',
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