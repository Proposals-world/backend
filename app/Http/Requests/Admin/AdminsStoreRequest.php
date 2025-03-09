<?php

namespace App\Http\Requests\Admin;
use App\Http\Requests\DefaultRequest;
use Illuminate\Foundation\Http\FormRequest;

class AdminsStoreRequest extends FormRequest
{
    use DefaultRequest;
    public function authorize(): bool
    {
        return auth()->check(); // Ensure the user is authenticated
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ];
    }
}