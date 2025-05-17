<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserFeedbackRequest extends FormRequest
{
    public function rules(): array
    {
        $locale = app()->getLocale();

        return [
            'match_id' => ['required', 'exists:user_matches,id'],
            'user_id' => ['required', 'exists:users,id'],
            'is_profile_accurate' => ['nullable', 'boolean'],
            'feedback_text_en' => $locale === 'ar' ? ['nullable'] : ['required', 'string'],
            'feedback_text_ar' => $locale === 'ar' ? ['required', 'string'] : ['nullable'],
            'outcome' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'feedback_text_en.required' => __('Please enter valid feedback in English.'),
            'feedback_text_ar.required' => __('يرجى إدخال ملاحظات صحيحة باللغة العربية.'),
            'outcome.required' => __('The outcome field is required.'),
            'match_id.unique' => __('You have already submitted feedback for this match.'),
        ];
    }
}
