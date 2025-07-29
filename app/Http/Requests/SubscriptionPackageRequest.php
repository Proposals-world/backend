<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\DefaultRequest;

class SubscriptionPackageRequest extends FormRequest
{


    use DefaultRequest;

    public function rules(): array
    {
        return [
            'package_name_en' => 'required|string|max:255',
            'package_name_ar' => 'required|string|max:255',
            'price'          => 'nullable|numeric|min:0',
            'target_gender'  => 'required|in:male,female',

            'contact_limit'  => 'nullable|integer|min:0|required_if:target_gender,male',
            'duration'       => 'nullable|integer|min:0|required_if:target_gender,female',
        ];
    }
}
