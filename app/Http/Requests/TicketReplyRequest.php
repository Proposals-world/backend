<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketReplyRequest extends FormRequest
{

    public function rules(): array
    {
        $locale = $this->header('Accept-Language', 'en');

        $rules = [
            'ticket_id' => 'required|exists:support_tickets,id',
        ];

        if ($locale === 'ar') {
            $rules['message_ar'] = 'required|string';
        } else {
            $rules['message_en'] = 'required|string';
        }

        return $rules;
    }

    public function messages(): array
    {
        $locale = $this->header('Accept-Language', 'en');

        if ($locale === 'ar') {
            return [
                'ticket_id.required'  => 'رقم التذكرة مطلوب.',
                'ticket_id.exists'    => 'رقم التذكرة غير موجود.',
                'message_ar.required' => 'الرسالة باللغة العربية مطلوبة.',
            ];
        }

        return [
            'ticket_id.required'  => 'Ticket ID is required.',
            'ticket_id.exists'    => 'Ticket ID does not exist.',
            'message_en.required' => 'The message in English is required.',
        ];
    }
}
