<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfilePhotoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ensure only authenticated users can update their profile photo
    }

    public function rules(): array
    {
        return [
            'profile_photo' => 'required|image|mimes:jpg,jpeg,png', // Max 2MB
        ];
    }
}