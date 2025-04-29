<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserFeedbackRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'match_id' => ['required', 'exists:user_matches,id'],
            'user_id' => 'required|exists:users,id',
            'is_profile_accurate' => 'required|boolean',
            'feedback_text_en' => [
                app()->getLocale() === 'ar' ? 'nullable' : 'required',
                'string',
            ],
            'feedback_text_ar' => [
                app()->getLocale() === 'ar' ? 'required' : 'nullable',
                'string',
            ],
            'outcome' => 'required|string|max:255',
        ];
    }
    public function messages()
    {
        if (app()->getLocale() === 'ar') {
            return [
                'feedback_text_en.regex' => 'يرجى إدخال ملاحظات صحيحة باللغة الإنجليزية.',
                'feedback_text_ar.regex' => 'يرجى إدخال ملاحظات صحيحة باللغة العربية.',
                'outcome.required' => 'حقل النتيجة مطلوب.',
                'match_id.unique' => 'لقد قمت بإرسال ملاحظات لهذا التطابق من قبل.',
            ];
        }

        return [
            'feedback_text_en.regex' => 'Please enter valid feedback in English.',
            'feedback_text_ar.regex' => 'Please enter valid feedback in Arabic.',
            'outcome.required' => 'The outcome field is required.',
            'match_id.unique' => 'You have already submitted feedback for this match.',
        ];
    }
}
