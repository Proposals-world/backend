<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    public function userPets()
    {
        return $this->hasMany(UserPet::class, 'pet_id');
    }

    public function userPreferredPets()
    {
        return $this->hasMany(UserPreferredPet::class, 'pet_id');
    }
}