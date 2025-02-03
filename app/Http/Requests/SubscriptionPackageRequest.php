<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionPackageRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust authorization as needed.
    }

    public function rules()
    {
        return [
            'package_name_en' => 'required|string|max:255',
            'package_name_ar' => 'required|string|max:255',
            'price'           => 'required|numeric|min:0',
            'duration_days'   => 'required|integer|min:1',
            'contact_limit'   => 'required|integer|min:0',
            // Optionally validate features if provided:
            'features'        => 'array',
            'features.*.id'   => 'required|exists:features,id',
            'features.*.included' => 'required|boolean',
        ];
    }
}
