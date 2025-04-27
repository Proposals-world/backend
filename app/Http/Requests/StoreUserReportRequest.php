<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'reported_id' => 'required|exists:users,id',
            'reason_en' => 'nullable|string',
            'reason_ar' => 'nullable|string',
            'other_reason_en' => 'nullable|string|max:1000',
            'other_reason_ar' => 'nullable|string|max:1000',
        ];
    }
}
