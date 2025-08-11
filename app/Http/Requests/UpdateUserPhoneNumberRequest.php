<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class UpdateUserPhoneNumberRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'country_code' => ['required', 'string', 'size:2'],
            'phone_number' => ['required', 'string'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->filled('country_code') && $this->filled('phone_number')) {
            $countries = config('countries');
            $iso       = $this->input('country_code');
            $dial      = $countries[$iso]['dial_code'] ?? '';
            $national  = preg_replace('/\D+/', '', $this->input('phone_number'));
            // Remove leading zero if present
            $national = ltrim($national, '0');

            // Build the E.164 string
            $this->merge(['_user_full_phone' => $dial . $national]);
        }
    }

    public function withValidator($validator)
    {
        $validator->after(function ($v) {
            if ($this->filled('_user_full_phone')) {
                // Validate country-specific
                $rule  = 'phone:' . $this->input('country_code');
                $check = Validator::make(
                    ['number' => $this->input('_user_full_phone')],
                    ['number' => $rule]
                );
                if (! $check->passes()) {
                    $v->errors()->add(
                        'phone_number',
                        __('validation.custom.phone_number.phone')
                    );
                }
            }
        });
    }
}
