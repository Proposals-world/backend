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
        return true; // Change this if you need authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     */
    // UserPreferenceRequest.php
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'preferred_nationality_id' => 'nullable|exists:nationalities,id',
            'preferred_origin_id' => 'nullable|exists:origins,id',
            'preferred_country_id' => 'nullable|exists:countries,id',
            'preferred_city_id' => 'nullable|exists:cities,id',
            'preferred_age_min' => 'nullable|integer',
            'preferred_age_max' => 'nullable|integer',
            'preferred_educational_level_id' => 'nullable|exists:educational_levels,id',
            'preferred_specialization_id' => 'nullable|exists:specializations,id',
            'preferred_employment_status' => 'nullable|boolean',
            'preferred_job_title_id' => 'nullable|exists:job_titles,id',
            'preferred_financial_status_id' => 'nullable|exists:financial_statuses,id',
            'preferred_height_id' => 'nullable|exists:heights,id',
            'preferred_weight_id' => 'nullable|exists:weights,id',
            'preferred_marital_status_id' => 'nullable|exists:marital_statuses,id',
            'preferred_smoking_status' => 'nullable|boolean',
            'preferred_smoking_tool_id' => 'nullable|exists:smoking_tools,id', // Ensure the smoking tool ID exists in the smoking_tools table
            'preferred_drinking_status_id' => 'nullable|exists:drinking_statuses,id',
            'preferred_sports_activity_id' => 'nullable|exists:sports_activities,id',
            'preferred_social_media_presence_id' => 'nullable|exists:social_media_presences,id',
            'marriage_budget_id' => 'nullable|exists:marriage_budgets,id',
            'must_have_criteria_en' => 'nullable|string',
            'must_have_criteria_ar' => 'nullable|string',
            'extra_features_en' => 'nullable|string',
            'extra_features_ar' => 'nullable|string',
        ];
    }
}
