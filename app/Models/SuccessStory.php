<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuccessStory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'partner_user_id',
        'story_text_en',
        'story_text_ar',
        'is_featured',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function partnerUser()
    {
        return $this->belongsTo(User::class, 'partner_user_id');
    }
}