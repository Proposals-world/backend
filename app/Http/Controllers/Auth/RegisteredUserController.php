<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */


    public function store(Request $request): RedirectResponse
    {
        $rules = [
              'first_name' => ['required', 'string', 'min:3', 'max:15'],
              'last_name'  => ['required', 'string', 'min:3', 'max:15'],
            'email'        => [
                'required',
                'string',
                'email',
                'max:255',
                'lowercase',
                Rule::unique(User::class),
            ],
            'phone_number' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^(078|077|079)\d{7}$/',
                Rule::unique(User::class),
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

        $messages = [
            // first_name
            'first_name.required' => __('validation.required', ['attribute' => __('validation.attributes.first_name')]),
            'first_name.string'   => __('validation.string',   ['attribute' => __('validation.attributes.first_name')]),
            // 'first_name.max'      => __('validation.max.string', ['attribute' => __('validation.attributes.first_name'), 'max' => 255]),
            'first_name.min'      => __('validation.min.string', ['attribute' => __('validation.attributes.first_name'), 'min' => 3]),
    'first_name.max'      => __('validation.max.string', ['attribute' => __('validation.attributes.first_name'), 'max' => 15]),
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

            // phone_number
            'phone_number.string' => __('validation.string',   ['attribute' => __('validation.attributes.phone_number')]),
            'phone_number.max'    => __('validation.max.string', ['attribute' => __('validation.attributes.phone_number'), 'max' => 255]),
            'phone_number.regex'  => __('validation.custom.phone_number.regex'),
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

        $validated = $request->validate($rules, $messages);

        $user = User::create([
            'first_name'     => $validated['first_name'],
            'last_name'      => $validated['last_name'],
            'email'          => $validated['email'],
            'phone_number'   => $validated['phone_number'] ?? null,
            'password'       => Hash::make($validated['password']),
            'profile_status' => 'active',
            'status'         => 'active',
            'gender'         => $validated['gender'],
            'role_id'        => 2,
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('user.dashboard');
    }
}
