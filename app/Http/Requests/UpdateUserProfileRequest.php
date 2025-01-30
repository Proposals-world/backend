<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'bio_en' => 'nullable|string|max:1000',
            'bio_ar' => 'nullable|string|max:1000',
            'gender' => 'required|string|in:male,female',
            'date_of_birth' => 'required|date',
            'height' => 'required|integer|exists:heights,id',
            'weight' => 'required|integer|exists:weights,id',
            'nationality_id' => 'required|integer|exists:nationalities,id',
            'origin_id' => 'nullable|integer|exists:origins,id',
            'country_of_residence_id' => 'required|integer|exists:zodiac_signs,id',
            'zodiac_sign_id' => 'nullable|integer|exists:countries,id',
            'city_id' => 'required|integer|exists:cities,id',
            'educational_level_id' => 'required|integer|exists:educational_levels,id',
            'specialization_id' => 'nullable|integer|exists:specializations,id',
            'employment_status' => 'required|boolean',
            'job_title_id' => 'nullable|integer|exists:job_titles,id',
            'smoking_status' => 'required|boolean',
            'smoking_tools' => 'nullable|array',
            'smoking_tools.*' => 'integer|exists:smoking_tools,id',
            'drinking_status_id' => 'nullable|integer|exists:drinking_statuses,id',
            'sports_activity_id' => 'nullable|integer|exists:sports_activities,id',
            'social_media_presence_id' => 'nullable|integer|exists:social_media_presences,id',
            'marital_status_id' => 'required|integer|exists:marital_statuses,id',
            'number_of_children' => 'nullable|integer|min:0',
            'housing_status_id' => 'required|integer|exists:housing_statuses,id',
            'hobbies' => 'nullable|array',
            'hobbies.*' => 'integer|exists:hobbies,id',
            'pets' => 'nullable|array',
            'hijab_status' => 'nullable|boolean',
            'financial_status_id' => 'required|integer|exists:financial_statuses,id',
            'pets.*' => 'integer|exists:pets,id',
            'health_issues_en' => 'nullable|string|max:2000',
            'health_issues_ar' => 'nullable|string|max:2000',
            'guardian_contact' => 'nullable|string|regex:/^\+?[0-9]{10,20}$/',
            'car_ownership' => 'required|boolean',
        ];
    }
}