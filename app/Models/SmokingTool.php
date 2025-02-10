<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmokingTool extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    public function userProfiles()
    {
        return $this->belongsToMany(UserProfile::class, 'user_smoking_tool_pivots', 'tool_id', 'user_profile_id');
    }
    public function userPreferences()
    {
        return $this->belongsToMany(UserPreference::class, 'user_preference_smoking_tool')
            ->withTimestamps();
    }
}
