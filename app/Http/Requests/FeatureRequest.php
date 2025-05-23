<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\DefaultRequest;


class FeatureRequest extends FormRequest
{

    use DefaultRequest;
    public function rules()
    {
        return [
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ];
    }
}
