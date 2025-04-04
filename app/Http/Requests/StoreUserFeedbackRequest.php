<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserFeedbackRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'match_id' => 'required|exists:user_matches,id|unique:user_feedback,match_id',
            'user_id' => 'required|exists:users,id',
            'is_profile_accurate' => 'required|boolean',
            'feedback_text_en' => 'required|string',
            'feedback_text_ar' => 'required|string',
            'outcome' => 'required|string|max:255',
        ];
    }
}
