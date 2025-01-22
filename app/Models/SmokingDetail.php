<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmokingDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'smoking_detail_id';

    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    // Relationships
    public function smokingStatuses()
    {
        return $this->hasMany(SmokingStatus::class, 'smoking_detail_id');
    }

    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class, 'smoking_detail_id');
    }

    public function userPreferences()
    {
        return $this->hasMany(UserPreference::class, 'preferred_smoking_status_id');
    }
}
