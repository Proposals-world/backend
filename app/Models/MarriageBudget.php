<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarriageBudget extends Model
{
    use HasFactory;

    protected $fillable = [
        'budget',
        'currency_id'
    ];

    public function userPreferences()
    {
        return $this->hasMany(UserPreference::class, 'marriage_budget_id');
    }
}