<?php

namespace App\Http\Requests;

use App\Http\Requests\DefaultRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfilePhotoRequest extends FormRequest
{

    use DefaultRequest;

    public function rules(): array
    {
        return [
            'profile_photo' => 'required|image|mimes:jpg,jpeg,png', // Max 2MB
        ];
    }
}
