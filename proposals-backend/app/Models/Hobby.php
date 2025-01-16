<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    use HasFactory;

    protected $primaryKey = 'hobby_id';

    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    // Relationships
    public function userPreferences()
    {
        return $this->hasMany(UserPreference::class, 'extra_features_id');
    }
}
