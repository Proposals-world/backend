<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $primaryKey = 'pet_id';

    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    // Relationships
    public function userPreferredPets()
    {
        return $this->hasMany(UserPreferredPet::class, 'pet_id');
    }
}
