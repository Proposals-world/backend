<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $primaryKey = 'city_id';

    protected $fillable = [
        'country_id',
        'name_en',
        'name_ar',
    ];

    // Relationships
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function locations()
    {
        return $this->hasMany(Location::class, 'city_id');
    }

    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class, 'city_id');
    }

    public function userPreferences()
    {
        return $this->hasMany(UserPreference::class, 'preferred_city_id');
    }
}
