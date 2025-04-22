<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketReplyRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'message' => 'required|string',
        ];
    }
    
    public function messages(): array
    {
        $locale = $this->header('Accept-Language', app()->getLocale());
    
        if ($locale === 'ar') {
            return [
                'message.required' => 'الرسالة مطلوبة.',
            ];
        }
    
        return [
            'message.required' => 'The message is required.',
        ];
    }
}
