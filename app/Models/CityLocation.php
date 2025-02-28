<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'name_en',
        'name_ar',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function users()
    {
        return $this->hasMany(User::class, 'city_location_id');
    }
}
