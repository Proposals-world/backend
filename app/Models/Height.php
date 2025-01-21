<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Height extends Model
{
    use HasFactory;

    protected $primaryKey = 'height_id';

    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    // Relationships
    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class, 'height_id');
    }

    public function userPreferences()
    {
        return $this->hasMany(UserPreference::class, 'preferred_height_id');
    }
}
