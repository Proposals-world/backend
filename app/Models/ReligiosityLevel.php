<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReligiosityLevel extends Model
{
    use HasFactory;

    // Define the table name if it doesn't follow Laravel's plural convention.
    // protected $table = 'religiosity_levels';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'gender',    // 1 for male, 2 for female
        'name_en',
        'name_ar',
    ];

    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class, 'religiosity_level_id');
    }

    public function userPreferences()
    {
        return $this->hasMany(UserPreference::class, 'preferred_religiosity_level_id');
    }
}
