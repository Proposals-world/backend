<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    */

    'required'             => 'The :attribute field is required.',
    'string'               => 'The :attribute must be a string.',
    'email'                => 'The :attribute must be a valid email address.',
    'max'                  => [
        'string' => 'The :attribute may not be greater than :max characters.',
    ],
    'min'                  => [
        'string' => 'The :attribute must be at least :min characters.',
    ],
    'confirmed'            => 'The :attribute confirmation does not match.',
    'unique'               => 'The :attribute has already been taken.',
    'in'                   => 'The selected :attribute is invalid.',
    'regex'                => 'The :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    */

    'password' => [
        'complexity' => 'The :attribute must contain at least one uppercase letter, one lowercase letter, one number and one symbol.',
    ],

    'custom' => [
         'first_name' => [
            'min' => 'The first name must be at least :min characters.',
            'max' => 'The first name may not be greater than :max characters.',
        ],
        'last_name' => [
            'min' => 'The last name must be at least :min characters.',
            'max' => 'The last name may not be greater than :max characters.',
        ],
        'email' => [
            'lowercase' => 'The email must be entirely lowercase.',
        ],
        'phone_number' => [
            'regex' => 'Your phone number must be exactly 10 digits and start with 078, 077, or 079.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    */

    'attributes' => [
        'first_name'   => 'first name',
        'last_name'    => 'last name',
        'email'        => 'email address',
        'phone_number' => 'phone number',
        'gender'       => 'gender',
        'password'     => 'password',
    ],

];
