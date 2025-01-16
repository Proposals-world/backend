<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{
    use HasFactory;

    protected $primaryKey = 'job_title_id';

    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    // Relationships
    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class, 'job_title_id');
    }

    public function userPreferences()
    {
        return $this->hasMany(UserPreference::class, 'preferred_job_title_id');
    }
}
