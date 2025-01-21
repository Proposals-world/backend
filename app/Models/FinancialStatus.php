<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialStatus extends Model
{
    use HasFactory;

    protected $primaryKey = 'financial_status_id';

    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    // Relationships
    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class, 'financial_status_id');
    }

    public function userPreferences()
    {
        return $this->hasMany(UserPreference::class, 'preferred_financial_status_id');
    }
}
