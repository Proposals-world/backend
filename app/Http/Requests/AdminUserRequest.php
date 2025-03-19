<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\DefaultRequest;

class StoreUserRequest extends FormRequest
{

    use DefaultRequest;

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'phone_number' => 'nullable|string|unique:users,phone_number',
            'password'     => 'required|string|min:6',
            'gender'       => 'required|string|in:male,female',
            'role_id'      => 'required|exists:roles,id',
        ];
    }
}
