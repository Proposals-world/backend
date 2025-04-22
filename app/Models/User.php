<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\AccountStatus;
use App\Enums\EmploymentStatus;
use App\Enums\Gender;
use App\Enums\MatchGender;
use App\Enums\MatchStatus;
use App\Enums\ReportStatus;
use App\Enums\SubscriptionStatus;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens;
    /** @use HasFactory<\Database\Factories\UserFactory>
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'password',
        'profile_status',
        'gender',
        'last_active',
        'status',
        'role_id'
    ];

    protected $casts = [
        'account status' => AccountStatus::class,
        'email_verified_at' => 'datetime',
        'employment_status' => EmploymentStatus::class,
        'match_gender' => MatchGender::class,
        'match status' => MatchStatus::class,
        'report status' => ReportStatus::class,
        'subscription status' => SubscriptionStatus::class,
        'smoking_status' => SmokingStatus::class,
        'zodiac_sign' => ZodiacSign::class,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp',
        'otp_expires_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'id');
    }

    public function agreements()
    {
        return $this->hasMany(UserAgreement::class);
    }

    public function preference()
    {
        return $this->hasOne(UserPreference::class);
    }



    public function preferredLanguages()
    {
        return $this->belongsToMany(Language::class, 'user_preferred_languages', 'user_id', 'language_id');
    }


    public function preferredPets()
    {
        return $this->hasMany(UserPreferredPet::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function reportsMade()
    {
        return $this->hasMany(UserReport::class, 'reporter_id');
    }

    public function reportsReceived()
    {
        return $this->hasMany(UserReport::class, 'reported_id');
    }

    public function blocksMade()
    {
        return $this->hasMany(UserBlock::class, 'blocker_id');
    }

    public function blocksReceived()
    {
        return $this->hasMany(UserBlock::class, 'blocked_id');
    }

    public function successStories()
    {
        return $this->hasMany(SuccessStory::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(UserFeedback::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function deviceTokens()
    {
        return $this->hasMany(DeviceToken::class);
    }

    public function supportTickets()
    {
        return $this->hasMany(SupportTicket::class);
    }

    public function supportReplies()
    {
        return $this->hasMany(SupportReply::class);
    }

    public function logs()
    {
        return $this->hasMany(UserLog::class);
    }

    public function emailLogs()
    {
        return $this->hasMany(EmailLog::class);
    }

    public function smsLogs()
    {
        return $this->hasMany(SmsLog::class);
    }


    public function verificationTokens()
    {
        return $this->hasMany(VerificationToken::class);
    }

    public function eventLogs()
    {
        return $this->hasMany(EventLog::class);
    }

    public function hobbies()
    {
        return $this->belongsToMany(Hobby::class, 'user_hobbies', 'user_id', 'hobbies_id');
    }

    public function pets()
    {
        return $this->belongsToMany(Pet::class, 'user_pets', 'user_id', 'pet_id');
    }

    public function photos()
    {
        return $this->hasMany(UserPhoto::class);
    }

    public function mainPhoto()
    {
        return $this->hasOne(UserPhoto::class)->where('is_main', true);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function dislikes()
    {
        return $this->hasMany(Dislike::class);
    }
    public function likedBy()
    {
        return $this->hasMany(Like::class, 'liked_user_id');
    }

    public function dislikedBy()
    {
        return $this->hasMany(Dislike::class, 'disliked_user_id');
    }
    public function matches()
    {
        return $this->hasMany(UserMatch::class, 'user1_id');
    }
    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }
    public function cityLocation()
    {
        return $this->belongsTo(City::class, 'city_location_id'); // Adjust the foreign key name if different
    }
    public function guardianOtps()
    {
        return $this->hasMany(GuardianOtp::class);
    }
}
