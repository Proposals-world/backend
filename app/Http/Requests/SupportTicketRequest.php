<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupportTicketRequest extends FormRequest
{
    public function rules(): array
    {
        $locale = $this->header('Accept-Language', 'en');

        if ($locale === 'ar') {
            return [
                'subject_ar'     => 'required|string|max:255',
                'description_ar' => 'required|string',
            ];
        }

        // Default to English
        return [
            'subject_en'     => 'required|string|max:255',
            'description_en' => 'required|string',
        ];
    }

    public function messages(): array
    {
        $locale = $this->header('Accept-Language', 'en');

        if ($locale === 'ar') {
            return [
                'subject_ar.required'     => 'العنوان باللغة العربية مطلوب.',
                'subject_ar.max'          => 'العنوان باللغة العربية لا يجب أن يتجاوز 255 حرفًا.',
                'description_ar.required' => 'الوصف باللغة العربية مطلوب.',
            ];
        }

        return [
            'subject_en.required'     => 'The subject in English is required.',
            'subject_en.max'          => 'The English subject must not exceed 255 characters.',
            'description_en.required' => 'The description in English is required.',
        ];
    }
}
