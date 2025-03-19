<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\DefaultRequest;

class FaqRequest extends FormRequest
{

    use DefaultRequest;


    public function rules(): array
    {
        return [
            'question_en' => 'required|string|max:255',
            'question_ar' => 'required|string|max:255',
            'answer_en'   => 'required|string|max:1000',
            'answer_ar'   => 'required|string|max:1000',
        ];
    }
}
