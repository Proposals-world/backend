<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'photo_url',
        'caption_en',
        'caption_ar',
        'is_verified',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}