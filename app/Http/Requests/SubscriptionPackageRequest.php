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
            'price'          => 'required|numeric|min:0',
            'contact_limit'  => 'required|integer|min:0',
        ];
    }
}
