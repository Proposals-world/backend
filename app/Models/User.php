<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'profile_status',
        'gender',
        'last_active',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_active' => 'datetime',
    ];

    // Relationships

    public function userProfile()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    public function userAgreements()
    {
        return $this->hasMany(UserAgreement::class, 'user_id');
    }

    public function userPreferences()
    {
        return $this->hasOne(UserPreference::class, 'user_id');
    }

    public function userPreferredLanguages()
    {
        return $this->hasMany(UserPreferredLanguage::class, 'user_id');
    }

    public function userPreferredPets()
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
        return $this->hasMany(UserPreferredLanguage::class);
    }

    public function preferredPets()
    {
        return $this->hasMany(UserPreferredPet::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function userRoles()
    {
        return $this->hasMany(UserRole::class);
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

    public function photos()
    {
        return $this->hasMany(UserPhoto::class);
    }

    public function verificationTokens()
    {
        return $this->hasMany(VerificationToken::class);
    }

    public function eventLogs()
    {
        return $this->hasMany(EventLog::class);
    }
}