<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class, 'educational_level_id');
    }

    public function userPreferences()
    {
        return $this->hasMany(UserPreference::class, 'preferred_educational_level_id');
    }
}