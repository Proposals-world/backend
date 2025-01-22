<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFeedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_id',
        'user_id',
        'is_profile_accurate',
        'feedback_text_en',
        'feedback_text_ar',
        'outcome',
    ];

    public function match()
    {
        return $this->belongsTo(UserMatch::class, 'match_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}