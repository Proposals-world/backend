<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketReplyRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'ticket_id' => 'required|exists:support_tickets,id',
            'message'   => 'required|string',
        ];
    }

    public function messages(): array
    {
        $locale = $this->header('Accept-Language', app()->getLocale());

        if ($locale === 'ar') {
            return [
                'ticket_id.required' => 'رقم التذكرة مطلوب.',
                'ticket_id.exists'   => 'رقم التذكرة غير موجود.',
                'message.required'   => 'الرسالة مطلوبة.',
            ];
        }

        return [
            'ticket_id.required' => 'Ticket ID is required.',
            'ticket_id.exists'   => 'Ticket ID does not exist.',
            'message.required'   => 'The message is required.',
        ];
    }
}
