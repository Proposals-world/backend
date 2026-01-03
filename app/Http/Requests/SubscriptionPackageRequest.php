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
            'package_name_en'      => 'required|string|max:255',
            'package_name_ar'      => 'required|string|max:255',
            'price'                => 'required|numeric|min:0',
            'target_gender'        => 'required|in:male,female',
            'gender'               => 'required|in:male,female',
            'is_one_time'          => 'required|boolean',
            'contact_limit'        => 'nullable|integer|min:0|required_if:target_gender,male',
            'duration'             => 'nullable|integer|min:0|required',
            'fintesa_product_id'   => 'nullable|string|max:255',
            'fintesa_price_id'     => 'nullable|string|max:255',
            'payment_url'          => 'nullable|url|max:500',
            'country_group_id'     => 'nullable|exists:country_groups,id',
            'is_default'           => 'nullable|boolean',
            'is_special_offer'     => 'nullable|boolean',
            'hide_package'        => 'nullable|boolean',
        ];
    }

    protected function prepareForValidation()
    {
        $gender = $this->input('target_gender', $this->input('gender'));

        $normalized = [
            'gender'       => $gender,
            'is_one_time'  => true, // جميع الباقات تعتبر دفعة مرة واحدة
            'is_default'   => $this->has('is_default') ? (bool) $this->is_default : false,
            'is_special_offer' => $this->has('is_special_offer') ? (bool) $this->is_special_offer : false,
        ];

        if ($gender === 'male') {
            // $normalized['duration'] = 0;
            $normalized['contact_limit'] = (int) ($this->contact_limit ?? 0);
        } elseif ($gender === 'female') {
            $normalized['contact_limit'] = 0;
            $normalized['duration'] = (int) ($this->duration ?? 0);
        }

        $this->merge($normalized);
    }
}
