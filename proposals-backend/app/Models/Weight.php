<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    use HasFactory;

    protected $primaryKey = 'weight_id';

    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    // Relationships
    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class, 'weight_id');
    }

    public function userPreferences()
    {
        return $this->hasMany(UserPreference::class, 'preferred_weight_id');
    }
}
