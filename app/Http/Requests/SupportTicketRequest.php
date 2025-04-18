<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupportTicketRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'subject'     => 'required|string|max:255',
            'description' => 'required|string',
        ];
    }

    public function messages(): array
    {
        $locale = $this->header('Accept-Language', config('app.locale', 'en'));

        if ($locale === 'ar') {
            return [
                'subject.required'     => 'العنوان باللغة العربية مطلوب.',
                'subject.max'          => 'العنوان باللغة العربية لا يجب أن يتجاوز 255 حرفًا.',
                'description.required' => 'الوصف باللغة العربية مطلوب.',
            ];
        }

        return [
            'subject.required'     => 'The subject in English is required.',
            'subject.max'          => 'The English subject must not exceed 255 characters.',
            'description.required' => 'The description in English is required.',
        ];
    }
}
