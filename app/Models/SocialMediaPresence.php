<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaPresence extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class, 'social_media_presence_id');
    }

    public function userPreferences()
    {
        return $this->hasMany(UserPreference::class, 'preferred_social_media_presence_id');
    }
}