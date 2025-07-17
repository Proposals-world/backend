<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests\DefaultRequest;

class UpdateUserProfileRequest extends FormRequest
{

    use DefaultRequest;

    protected function prepareForValidation(): void
    {
        if ($this->filled('country_code') && $this->filled('guardian_contact')) {
            $countries = config('countries');
            $iso       = $this->input('country_code');
            $dial      = $countries[$iso]['dial_code'] ?? '';

            $national  = preg_replace('/\D+/', '', $this->input('guardian_contact'));
            // Remove leading zero if present
            $national = ltrim($national, '0');
            // merge a full E.164 number for validation & use
            $this->merge(['_guardian_full' => $dial . $national]);
        }
    }

    public function rules()
    {
        $country = $this->input('country_code') ?: 'ANY';

        $rules = [
            'nickname' => 'required|string|max:255',
            'photo_url' => 'nullable|image',
            'bio_en' => 'nullable|string|max:1000',
            'bio_ar' => 'nullable|string|max:1000',
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
            'marital_status_id' => 'nullable|integer|exists:marital_statuses,id',
            'number_of_children' => 'nullable|integer|min:0',
            'religion_id' => 'required|integer|exists:religions,id',
            'skin_color_id' => 'required|integer|exists:skin_colors,id',
            'hair_color_id' => 'required|integer|exists:hair_colors,id',
            'housing_status_id' => 'nullable|integer|exists:housing_statuses,id',
            'hobbies' => 'nullable|array',
            'hobbies.*' => 'integer|exists:hobbies,id',
            'pets' => 'nullable|array',
            'hijab_status' => 'nullable|boolean',
            'financial_status_id' => 'required|integer|exists:financial_statuses,id',
            'pets.*' => 'integer|exists:pets,id',
            'health_issues_en' => 'nullable|string|max:2000',
            'health_issues_ar' => 'nullable|string|max:2000',
            'guardian_contact' => 'nullable|string',
            'car_ownership' => 'required|boolean',
            'religiosity_level_id' => 'required|integer|exists:religiosity_levels,id',
            'sleep_habit_id' => 'nullable|integer|exists:sleep_habits,id',
            'marriage_budget_id' => 'nullable|integer|exists:marriage_budgets,id',
            'position_level_id' => 'nullable|integer|exists:position_levels,id',
            'eye_color_id' => 'nullable|integer|exists:eye_colors,id',
            'city_location_id' => 'nullable|string|max:255',
            // 'country_code'      => 'required|string|size:2',

        ];
        // 👇 Apply only if authenticated user is female
        if (auth()->user()?->gender === 'female') {
            $rules['country_code'] = 'required|string|size:2';
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
    public function withValidator($validator)
    {
        $validator->after(function ($v) {
            if ($this->filled('_guardian_full')) {
                // apply country‐specific phone rule
                $rule  = 'phone:' . $this->input('country_code');
                $check = Validator::make(
                    ['full' => $this->input('_guardian_full')],
                    ['full' => $rule]
                );
                if (! $check->passes()) {
                    $v->errors()->add(
                        'guardian_contact',
                        __('validation.custom.phone_number.phone')
                    );
                }
            }
        });
    }
}
