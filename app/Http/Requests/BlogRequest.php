<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\DefaultRequest;

class BlogRequest extends FormRequest
{

    // use DefaultRequest;

    /**
     * Validation rules for blog creation.
     */
    public function rules(): array
    {
        return [
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'content_en' => 'required',
            'content_ar' => 'required',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ];
    }
}
