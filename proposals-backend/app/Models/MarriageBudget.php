<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarriageBudget extends Model
{
    use HasFactory;

    protected $primaryKey = 'marriage_budget_id';

    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    // Relationships
    public function userPreferences()
    {
        return $this->hasMany(UserPreference::class, 'marriage_budget_id');
    }
}
