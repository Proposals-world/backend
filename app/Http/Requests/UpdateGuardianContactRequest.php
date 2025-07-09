<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class UpdateGuardianContactRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'country_code'      => ['required', 'string', 'size:2'],
            'guardian_contact'  => ['required', 'string'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->filled('country_code') && $this->filled('guardian_contact')) {
            $countries = config('countries');
            $iso       = $this->input('country_code');
            $dial      = $countries[$iso]['dial_code'] ?? '';
            $national  = preg_replace('/\D+/', '', $this->input('guardian_contact'));

            // Build the E.164 string
            $this->merge(['_guardian_full' => $dial . $national]);
        }
    }

    public function withValidator($validator)
    {
        $validator->after(function ($v) {
            if ($this->filled('_guardian_full')) {
                // Validate country‐specific
                $rule  = 'phone:' . $this->input('country_code');
                $check = Validator::make(
                    ['number' => $this->input('_guardian_full')],
                    ['number' => $rule]
                );
                if (! $check->passes()) {
                    $v->errors()->add(
                        'guardian_contact',
                        __('validation.custom.phone_number.phone')
                    );
                }
            }
        });
    }
}
