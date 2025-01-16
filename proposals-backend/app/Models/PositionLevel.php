<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionLevel extends Model
{
    use HasFactory;

    protected $primaryKey = 'position_level_id';

    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    // Relationships
    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class, 'position_level_id');
    }

    public function userPreferences()
    {
        return $this->hasMany(UserPreference::class, 'preferred_position_level_id');
    }
}
