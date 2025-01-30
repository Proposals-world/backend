<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    // Disable auto-incrementing since 'id' is not auto-incremented
    public $incrementing = false;

    // Specify the primary key type
    protected $keyType = 'unsignedBigInteger';

    protected $fillable = [
        'id',
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
        'guardian_contact_encrypted',
    ];

    /**
     * Since 'id' is both primary key and foreign key, override the default primary key.
     */
    protected $primaryKey = 'id';

    /**
     * Define the relationship to the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }

    public function origin()
    {
        return $this->belongsTo(Origin::class);
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }

    public function countryOfResidence()
    {
        return $this->belongsTo(Country::class, 'country_of_residence_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function zodiacSign()
    {
        return $this->belongsTo(ZodiacSign::class);
    }

    public function educationalLevel()
    {
        return $this->belongsTo(EducationalLevel::class);
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function positionLevel()
    {
        return $this->belongsTo(PositionLevel::class);
    }

    public function financialStatus()
    {
        return $this->belongsTo(FinancialStatus::class);
    }

    public function housingStatus()
    {
        return $this->belongsTo(HousingStatus::class, 'housing_id');
    }

    public function height()
    {
        return $this->belongsTo(Height::class);
    }

    public function weight()
    {
        return $this->belongsTo(Weight::class);
    }

    public function maritalStatus()
    {
        return $this->belongsTo(MaritalStatus::class);
    }

    public function skinColor()
    {
        return $this->belongsTo(SkinColor::class);
    }

    public function hairColor()
    {
        return $this->belongsTo(HairColor::class);
    }

    public function hijabStatus()
    {
        return $this->belongsTo(HijabStatus::class);
    }

    public function smokingStatus()
    {
        return $this->belongsTo(SmokingStatus::class);
    }

    public function drinkingStatus()
    {
        return $this->belongsTo(DrinkingStatus::class);
    }

    public function sportsActivity()
    {
        return $this->belongsTo(SportsActivity::class);
    }

    public function socialMediaPresence()
    {
        return $this->belongsTo(SocialMediaPresence::class);
    }

    public function photos()
    {
        return $this->hasMany(UserPhoto::class);
    }

    public function smokingTools()
    {
        return $this->belongsToMany(SmokingTool::class, 'user_smoking_tool_pivots', 'user_profile_id', 'tool_id');
    }
}