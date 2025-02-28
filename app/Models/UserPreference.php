<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'preferred_nationality_id',
        'preferred_origin_id',
        'preferred_country_id',
        'preferred_city_id',
        'preferred_age_min',
        'preferred_age_max',
        'preferred_educational_level_id',
        'preferred_specialization_id',
        'preferred_employment_status',
        'preferred_job_title_id',
        'preferred_financial_status_id',
        'preferred_height_id',
        'preferred_weight_id',
        'preferred_marital_status_id',
        'preferred_smoking_status',
        "preferred_smoking_tool_id",
        'preferred_drinking_status_id',
        'preferred_sports_activity_id',
        'preferred_social_media_presence_id',
        'preferred_marriage_budget_id',
        'preferred_sleep_habit_id',
        'preferred_religiosity_level_id',
        'preferred_language_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function preferredNationality()
    {
        return $this->belongsTo(Nationality::class, 'preferred_nationality_id');
    }

    public function preferredOrigin()
    {
        return $this->belongsTo(Origin::class, 'preferred_origin_id');
    }

    public function preferredCountry()
    {
        return $this->belongsTo(Country::class, 'preferred_country_id');
    }

    public function preferredCity()
    {
        return $this->belongsTo(City::class, 'preferred_city_id');
    }

    public function preferredEducationalLevel()
    {
        return $this->belongsTo(EducationalLevel::class, 'preferred_educational_level_id');
    }

    public function preferredSpecialization()
    {
        return $this->belongsTo(Specialization::class, 'preferred_specialization_id');
    }

    public function preferredJobTitle()
    {
        return $this->belongsTo(JobTitle::class, 'preferred_job_title_id');
    }

    public function preferredFinancialStatus()
    {
        return $this->belongsTo(FinancialStatus::class, 'preferred_financial_status_id');
    }

    public function preferredHeight()
    {
        return $this->belongsTo(Height::class, 'preferred_height_id');
    }

    public function preferredWeight()
    {
        return $this->belongsTo(Weight::class, 'preferred_weight_id');
    }

    public function preferredMaritalStatus()
    {
        return $this->belongsTo(MaritalStatus::class, 'preferred_marital_status_id');
    }

    public function preferredDrinkingStatus()
    {
        return $this->belongsTo(DrinkingStatus::class, 'preferred_drinking_status_id');
    }

    public function preferredSportsActivity()
    {
        return $this->belongsTo(SportsActivity::class, 'preferred_sports_activity_id');
    }

    public function preferredSocialMediaPresence()
    {
        return $this->belongsTo(SocialMediaPresence::class, 'preferred_social_media_presence_id');
    }

    public function preferredmarriageBudget()
    {
        return $this->belongsTo(MarriageBudget::class, 'preferred_marriage_budget_id');
    }

    public function preferredsleepHabit()
    {
        return $this->belongsTo(SleepHabit::class, 'preferred_sleep_habit_id');
    }
    public function preferredreligiosityLevel()
    {
        return $this->belongsTo(ReligiosityLevel::class, 'preferred_religiosity_level_id');
    }
    public function smokingTools()
    {
        return $this->belongsToMany(SmokingTool::class, 'user_preference_smoking_tool', 'user_preference_id', 'smoking_tool_id');
    }
    public function pets()
    {
        return $this->belongsToMany(Pet::class, 'user_preferred_pets', 'user_id', 'pet_id');
    }
    public function language()
    {
        return $this->belongsTo(Language::class, 'preferred_language_id');
    }
}
