<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $primaryKey = 'country_id';

    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    // Relationships
    public function cities()
    {
        return $this->hasMany(City::class, 'country_id');
    }

    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class, 'country_of_residence_id');
    }

    public function locations()
    {
        return $this->hasMany(Location::class, 'country_id');
    }

    public function userPreferences()
    {
        return $this->hasMany(UserPreference::class, 'preferred_country_id');
    }
}
