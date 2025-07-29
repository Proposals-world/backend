<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use libphonenumber\PhoneNumberUtil;
use App\Models\User;

class RegisterUserRequest extends FormRequest
{
    /**
     * Prepare the data for validation by merging country code and national number into E.164 format.
     */
    protected function prepareForValidation(): void
    {
        $countries = config('countries');
        $iso       = $this->input('country_code');

        if ($this->filled('country_code') && $this->filled('phone_number')) {
            $dialCode = $countries[$iso]['dial_code'] ?? '';
            $national = preg_replace('/\D+/', '', $this->input('phone_number'));
            $this->merge([
                'phone_number' => $dialCode . $national,
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $country = $this->input('country_code') ?: 'ANY';

        return [
            'first_name'   => ['required', 'string', 'min:3', 'max:15'],
            'last_name'    => ['required', 'string', 'min:3', 'max:15'],
            'email'        => [
                'required',
                'string',
                'email',
                'max:255',
                'lowercase',
                Rule::unique(User::class, 'email'),
            ],
            'country_code' => ['required', 'string', 'size:2'],
            'phone_number' => [
                'nullable',
                'string',
                'phone:' . $country,
                Rule::unique(User::class, 'phone_number'),
            ],
            'gender'       => ['required', Rule::in(['male', 'female'])],
            'password'     => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).+$/',
            ],
        ];
    }

    /**
     * Get custom error messages for validator failures.
     */
    public function messages(): array
    {
        return [
            // first_name
            'first_name.required' => __('validation.required', ['attribute' => __('validation.attributes.first_name')]),
            'first_name.string'   => __('validation.string',   ['attribute' => __('validation.attributes.first_name')]),
            'first_name.max'      => __('validation.max.string', ['attribute' => __('validation.attributes.first_name'), 'max' => 255]),

            // last_name
            'last_name.required'  => __('validation.required', ['attribute' => __('validation.attributes.last_name')]),
            'last_name.string'    => __('validation.string',   ['attribute' => __('validation.attributes.last_name')]),
            'last_name.max'       => __('validation.max.string', ['attribute' => __('validation.attributes.last_name'), 'max' => 255]),

            // email
            'email.required'      => __('validation.required', ['attribute' => __('validation.attributes.email')]),
            'email.string'        => __('validation.string',   ['attribute' => __('validation.attributes.email')]),
            'email.email'         => __('validation.email',    ['attribute' => __('validation.attributes.email')]),
            'email.max'           => __('validation.max.string', ['attribute' => __('validation.attributes.email'), 'max' => 255]),
            'email.lowercase'     => __('validation.custom.email.lowercase'),
            'email.unique'        => __('validation.unique',   ['attribute' => __('validation.attributes.email')]),

            // country_code
            'country_code.required' => __('validation.required', ['attribute' => __('validation.attributes.country_code')]),
            'country_code.size'     => __('validation.size.string', ['attribute' => __('validation.attributes.country_code'), 'size' => 2]),

            // phone_number
            'phone_number.string' => __('validation.string',   ['attribute' => __('validation.attributes.phone_number')]),
            'phone_number.phone'  => __('validation.custom.phone_number.phone'),
            'phone_number.unique' => __('validation.unique',   ['attribute' => __('validation.attributes.phone_number')]),

            // gender
            'gender.required'     => __('validation.required', ['attribute' => __('validation.attributes.gender')]),
            'gender.in'           => __('validation.in',       ['attribute' => __('validation.attributes.gender'), 'values' => 'male, female']),

            // password
            'password.required'   => __('validation.required', ['attribute' => __('validation.attributes.password')]),
            'password.string'     => __('validation.string',   ['attribute' => __('validation.attributes.password')]),
            'password.min'        => __('validation.min.string', ['attribute' => __('validation.attributes.password'), 'min' => 8]),
            'password.confirmed'  => __('validation.confirmed', ['attribute' => __('validation.attributes.password')]),
            'password.regex'      => __('validation.password.complexity'),
        ];
    }
}
