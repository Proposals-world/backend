<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;    // <<— import this
use Illuminate\Support\Str;
use Propaganistas\LaravelPhone\PhoneNumber;

class UserProfile extends Model
{
    use HasFactory;

    // Disable auto-incrementing since 'id' is not auto-incremented
    public $incrementing = false;

    // Specify the primary key type
    protected $keyType = 'unsignedBigInteger';

    protected $fillable = [
        'id',
        'nickname',
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
        'city_location_id',
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
        'hijab_status',
        'smoking_status',
        'drinking_status_id',
        'sports_activity_id',
        'marriage_budget_id',
        'social_media_presence_id',
        'country_code',
        'guardian_contact_encrypted',
        'religiosity_level_id',
        'sleep_habit_id',
        'eye_color_id',
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
    public function cityLocation()
    {
        return $this->belongsTo(CityLocation::class, 'city_location_id');
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

    public function sleepHabit()
    {
        return $this->belongsTo(SleepHabit::class, 'sleep_habit_id');
    }
    public function marriageBudget()
    {
        return $this->belongsTo(MarriageBudget::class, 'marriage_budget_id');
    }
    public function religiosityLevel()
    {
        return $this->belongsTo(ReligiosityLevel::class);
    }
    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function eyeColor()
    {
        return $this->belongsTo(EyeColor::class);
    }
    public function hobbies()
    {
        return $this->belongsToMany(Hobby::class, 'user_hobby_pivots', 'user_profile_id', 'hobby_id');
    }
    /**
     * Can this profile be updated now?
     */
    public function canBeUpdated(): bool
    {
        return $this->updated_at
            ->copy()
            ->addDays(14)
            ->isPast();
    }
    /**
     * Return just the local (national) portion of the guardian’s E.164 number.
     */
    public function getGuardianContactLocalAttribute(): string
    {
        $full = $this->guardian_contact_encrypted ?? '';
        $iso  = $this->country_code ?: 'JO'; // default if missing

        if (! $full) {
            return '';
        }

        try {
            // Parse & re‐format as national
            $national = PhoneNumber::make($full, $iso)->formatNational();

            // Optionally, strip out all non‐digits if you want a plain string:
            return preg_replace('/\D+/', '', $national);
        } catch (\Exception $e) {
            // fallback to stripping off the dial prefix
            $dial = config('countries')[$iso]['dial_code'] ?? '';
            if (Str::startsWith($full, $dial)) {
                return substr($full, strlen($dial));
            }

            return ltrim($full, '+');
        }
    }

    /**
     * When will the next update window open?
     */
    public function nextAllowedUpdateAt(): Carbon
    {
        return $this->updated_at->copy()->addDays(14);
    }
}
