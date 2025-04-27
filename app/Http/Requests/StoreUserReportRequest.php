<?php

namespace App\Http\Requests;

use App\Models\UserReport;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // ✅ Allow everyone who is logged in
    }

    public function rules(): array
    {
        $lang = $this->header('lang', 'en'); // Default to 'en' if the header is not provided
        return [
            'reported_id' => ['required', 'exists:users,id'],
            'reason_' . $lang => [
                'required',
                Rule::in(
                    $lang === 'ar' ? UserReport::REASONS_AR : UserReport::REASONS_EN
                ),
            ],

            'other_reason_' . $lang => [
                'nullable',
                'string',
                'max:1000',
                function ($attribute, $value, $fail) use ($lang) {
                    if ($this->input('reason_' . $lang) === 'other' && !$value) {
                        $fail('Other reason must be provided when reason is other.');
                    }
                },
            ],
        ];
    }
}
