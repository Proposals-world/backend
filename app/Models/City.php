<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'name_en',
        'name_ar',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class);
    }
}