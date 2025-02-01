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
        $rules = [
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'bio_en' => 'nullable|string|max:1000',
            'bio_ar' => 'nullable|string|max:1000',
            'gender' => 'required|string|in:male,female',
            'date_of_birth' => 'required|date',
            'height' => 'required|integer|exists:heights,id',
            'weight' => 'required|integer|exists:weights,id',
            'nationality_id' => 'required|integer|exists:nationalities,id',
            'origin_id' => 'nullable|integer|exists:origins,id',
            'country_of_residence_id' => 'required|integer|exists:countries,id',
            'zodiac_sign_id' => 'nullable|integer|exists:zodiac_signs,id',
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
            'religion_id' => 'required|integer|exists:religions,id',
            'skin_color_id' => 'required|integer|exists:skin_colors,id',
            'hair_color_id' => 'required|integer|exists:hair_colors,id',
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

        if ($this->input('gender') === 'male') {
            $rules['hijab_status'] = [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value !== null && $value != 0) {
                        $fail('Male cannot dress hijab.');
                    }
                },
            ];
        }

        if ($this->input('smoking_status') == 1) {
            $rules['smoking_tools'] = [
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