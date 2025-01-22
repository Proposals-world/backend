<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportsActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class, 'sports_activity_id');
    }

    public function userPreferences()
    {
        return $this->hasMany(UserPreference::class, 'preferred_sports_activity_id');
    }
}