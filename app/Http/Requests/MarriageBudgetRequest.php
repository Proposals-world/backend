<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\DefaultRequest;

class MarriageBudgetRequest extends FormRequest
{

    use DefaultRequest;

    public function rules(): array
    {
        return [
            'budget_en' => 'required|string|max:255',
            'budget_ar' => 'required|string|max:255',
        ];
    }
}
