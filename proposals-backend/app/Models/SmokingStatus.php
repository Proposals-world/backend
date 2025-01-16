<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmokingStatus extends Model
{
    use HasFactory;

    protected $primaryKey = 'smoking_status_id';

    protected $fillable = [
        'smoking_detail_id',
        'status',
    ];

    // Relationships
    public function smokingDetail()
    {
        return $this->belongsTo(SmokingDetail::class, 'smoking_detail_id');
    }

    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class, 'smoking_status_id');
    }

    public function userPreferences()
    {
        return $this->hasMany(UserPreference::class, 'preferred_smoking_status_id');
    }
}
