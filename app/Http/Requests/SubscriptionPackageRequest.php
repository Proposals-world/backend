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
            'target_gender'  => 'required|in:male,female',
            'gender'         => 'required|in:male,female',
            'is_one_time'    => 'required|boolean',
            'contact_limit'  => 'nullable|integer|min:0|required_if:target_gender,male',
            'duration'       => 'nullable|integer|min:0|required_if:target_gender,female',
        ];
    }
    protected function prepareForValidation()
    {
        $gender = $this->input('target_gender', $this->input('gender'));

        // All packages are one-time payments now, but keep gender-specific behavior
        $normalized = [
            'gender' => $gender,
            'is_one_time' => true, // All packages are one-time payments depending on gender we will activate the subscription later
        ];

        if ($gender === 'male') {
            // For males: forcibly zero out duration; require contact_limit
            $normalized['duration'] = 0;
            $normalized['contact_limit'] = (int) ($this->contact_limit ?? 0);
        } elseif ($gender === 'female') {
            // For females: forcibly zero out contact_limit; require duration
            $normalized['contact_limit'] = 0;
            $normalized['duration'] = (int) ($this->duration ?? 0);
        }

        $this->merge($normalized);
    }
}
