<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\DefaultRequest;
use Illuminate\Foundation\Http\FormRequest;

class CategoriesUpdateRequest extends FormRequest
{
    use DefaultRequest;

    public function rules(): array
    {
        $category = $this->route('category');

        return [
            'name_en' => 'required|string|max:255|unique:categories,name_en,' . $category->id,
            'name_ar' => 'required|string|max:255|unique:categories,name_ar,' . $category->id,
        ];
    }
}
