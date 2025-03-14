<?php

namespace App\Http\Requests\Admin;
use App\Http\Requests\DefaultRequest;
use Illuminate\Foundation\Http\FormRequest;

class CategoriesStoreRequest extends FormRequest
{
    use DefaultRequest;
    public function authorize(): bool
    {
        return auth()->check(); // Ensure the user is authenticated
    }

    public function rules(): array
    {
        return [
            'name_en' => 'required|string|max:255|unique:categories,name_en',
            'name_ar' => 'required|string|max:255|unique:categories,name_ar',
        ];
    }
}
