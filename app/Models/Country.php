<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class, 'country_of_residence_id');
    }
}