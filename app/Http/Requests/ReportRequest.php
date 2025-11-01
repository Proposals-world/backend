<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\DefaultRequest;


class ReportRequest extends FormRequest
{
    use DefaultRequest;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $acceptLanguage = request()->header('Accept-Language', 'en');

        return [
            // 'reporter_id' => 'required|exists:users,id', // Ensure the reporter exists
            'reported_id' => 'required|exists:users,id', // Ensure the reported user exists
            'reason_en' => $acceptLanguage === 'en' ? 'required|in:Inappropriate Photos,Offensive Language,Spam or Advertising,Other' : 'nullable', // Valid English reason
            'reason_ar' => $acceptLanguage === 'ar' ? 'required|in:صور غير لائقة,ألفاظ مسيئة,رسائل مزعجة أو إعلانات,أخرى' : 'nullable', // Valid Arabic reason
            'other_reason_en' => $acceptLanguage === 'en' ? 'nullable|string|max:255|required_if:reason_en,other' : 'nullable', // Custom reason in English, required if 'other' is selected
            'other_reason_ar' => $acceptLanguage === 'ar' ? 'nullable|string|max:255|required_if:reason_ar,أخرى' : 'nullable', // Custom reason in Arabic, required if 'أخرى' is selected
            'status' => 'required|in:pending,reviewed,resolved,rejected', // Valid status
            'report_count' => 'nullable|integer|min:1', // Valid report count (cannot be less than 1)
            'reported_photo' => 'nullable|image|max:2048', // Optional reported photo
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'reporter_id.required' => 'The reporter is required.',
            'reported_id.required' => 'The reported user is required.',
            'reason_en.required' => 'The reason in English is required.',
            'reason_ar.required' => 'The reason in Arabic is required.',
            'reason_en.in' => 'The reason in English must be one of the following: Inappropriate Photos, Offensive Language, Spam or Advertising, or Other.',
            'reason_ar.in' => 'The reason in Arabic must be one of the following: صور غير لائقة, ألفاظ مسيئة, رسائل مزعجة أو إعلانات, or أخرى.',

            'other_reason_en.string' => 'The other reason in English must be a string.',
            'other_reason_ar.string' => 'The other reason in Arabic must be a string.',
            'other_reason_en.max' => 'The other reason in English must not be greater than 255 characters.',
            'other_reason_ar.max' => 'The other reason in Arabic must not be greater than 255 characters.',
            'other_reason_en.required_if' => 'The other reason in English is required when the reason is "other".',
            'other_reason_ar.required_if' => 'The other reason in Arabic is required when the reason is "أخرى".',
            'status.required' => 'The status is required.',
            'status.in' => 'The status must be one of the following: pending, reviewed, resolved, or rejected.',
            'report_count.required' => 'The report count is required.',
            'report_count.integer' => 'The report count must be an integer.',
            'report_count.min' => 'The report count must be at least 1.',
        ];
    }
}
