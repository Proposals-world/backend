<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class);
    }

    public function userPreferences()
    {
        return $this->hasMany(UserPreference::class, 'preferred_financial_status_id');
    }
}