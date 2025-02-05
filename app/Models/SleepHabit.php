<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SleepHabit extends Model
{
    use HasFactory;

    // Define the table name if necessary.
    // protected $table = 'sleep_habits';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class , 'sleep_habit_id');
    }

    public function userPreferences()
    {
        return $this->hasMany(UserPreference::class, 'preferred_sleep_habit_id');
    }
}