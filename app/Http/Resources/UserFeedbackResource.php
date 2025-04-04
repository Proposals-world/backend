<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserFeedbackResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $matchedUser = $this->match->matched_user; // uses getMatchedUserAttribute()

        return [
            'id' => $this->id,
            'match_id' => $this->match_id,
            'user_id' => $this->user_id,
            'user_first_name' => $this->user->first_name,
            'user_last_name' => $this->user->last_name,
            'is_profile_accurate' => $this->is_profile_accurate,
            'feedback_text_en' => $this->feedback_text_en,
            'feedback_text_ar' => $this->feedback_text_ar,
            'outcome' => $this->outcome,
            'created_at' => $this->created_at,

            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
            ],

            'match' => [
                'id' => $this->match->id,
                'matched_user' => $matchedUser ? [
                    'id' => $matchedUser->id,
                    'name' => $matchedUser->name,
                    'email' => $matchedUser->email,
                    'first_name' => $matchedUser->first_name,
                    'last_name' => $matchedUser->last_name,
                ] : null,
            ],
        ];
    }
}
