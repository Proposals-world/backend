<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmokingStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];

    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class);
    }

    public function userSmokingToolPivots()
    {
        return $this->hasMany(UserSmokingToolPivot::class);
    }
}