<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bio_en',
        'bio_ar',
        'avatar_url',
        'id_number',
        'criminal_record_url',
        'id_verification_status',
        'criminal_record_status',
        'nationality_id',
        'origin_id',
        'religion_id',
        'country_of_residence_id',
        'city_id',
        'area',
        'date_of_birth',
        'age',
        'zodiac_sign_id',
        'educational_level_id',
        'specialization_id',
        'employment_status',
        'job_title_id',
        'sector_id',
        'position_level_id',
        'financial_status_id',
        'housing_id',
        'car_ownership',
        'height_id',
        'weight_id',
        'health_issues_en',
        'health_issues_ar',
        'marital_status_id',
        'children',
        'skin_color_id',
        'hair_color_id',
        'hijab_status_id',
        'smoking_status_id',
        'drinking_status_id',
        'sports_activity_id',
        'social_media_presence_id',
        'guardian_contact_en',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }

    public function origin()
    {
        return $this->belongsTo(Origin::class, 'origin_id');
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class, 'religion_id');
    }

    public function countryOfResidence()
    {
        return $this->belongsTo(Country::class, 'country_of_residence_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function zodiacSign()
    {
        return $this->belongsTo(ZodiacSign::class, 'zodiac_sign_id');
    }

    public function educationalLevel()
    {
        return $this->belongsTo(EducationalLevel::class, 'educational_level_id');
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id');
    }

    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class, 'job_title_id');
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class, 'sector_id');
    }

    public function positionLevel()
    {
        return $this->belongsTo(PositionLevel::class, 'position_level_id');
    }

    public function financialStatus()
    {
        return $this->belongsTo(FinancialStatus::class, 'financial_status_id');
    }

    public function housingStatus()
    {
        return $this->belongsTo(HousingStatus::class, 'housing_id');
    }

    public function height()
    {
        return $this->belongsTo(Height::class, 'height_id');
    }

    public function weight()
    {
        return $this->belongsTo(Weight::class, 'weight_id');
    }

    public function maritalStatus()
    {
        return $this->belongsTo(MaritalStatus::class, 'marital_status_id');
    }

    public function skinColor()
    {
        return $this->belongsTo(SkinColor::class, 'skin_color_id');
    }

    public function hairColor()
    {
        return $this->belongsTo(HairColor::class, 'hair_color_id');
    }

    public function hijabStatus()
    {
        return $this->belongsTo(HijabStatus::class, 'hijab_status_id');
    }

    public function smokingStatus()
    {
        return $this->belongsTo(SmokingStatus::class, 'smoking_status_id');
    }

    public function drinkingStatus()
    {
        return $this->belongsTo(DrinkingStatus::class, 'drinking_status_id');
    }

    public function sportsActivity()
    {
        return $this->belongsTo(SportsActivity::class, 'sports_activity_id');
    }

    public function socialMediaPresence()
    {
        return $this->belongsTo(SocialMediaPresence::class, 'social_media_presence_id');
    }
}
