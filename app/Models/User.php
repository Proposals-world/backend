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
        'password',
        'username',
        'email',
        'phone_number',
        'password_hash',
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
        return $this->hasMany(UserPreferredPet::class, 'user_id');
    }

    public function userRoles()
    {
        return $this->hasMany(UserRole::class, 'user_id');
    }

    public function matchesUser1()
    {
        return $this->hasMany(Match::class, 'user1_id');
    }

    public function matchesUser2()
    {
        return $this->hasMany(Match::class, 'user2_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'user_id');
    }

    public function paymentTransactions()
    {
        return $this->hasMany(PaymentTransaction::class, 'user_id');
    }

    public function userReports()
    {
        return $this->hasMany(UserReport::class, 'reporter_id');
    }

    public function userBlocks()
    {
        return $this->hasMany(UserBlock::class, 'blocker_id');
    }

    public function successStories()
    {
        return $this->hasMany(SuccessStory::class, 'user_id');
    }

    public function userFeedbacks()
    {
        return $this->hasMany(UserFeedback::class, 'user_id');
    }

    public function userLogs()
    {
        return $this->hasMany(UserLog::class, 'user_id');
    }

    public function userPhotos()
    {
        return $this->hasMany(UserPhoto::class, 'user_id');
    }

    public function verificationTokens()
    {
        return $this->hasMany(VerificationToken::class, 'user_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    public function deviceTokens()
    {
        return $this->hasMany(DeviceToken::class, 'user_id');
    }

    public function eventLogs()
    {
        return $this->hasMany(EventLog::class, 'user_id');
    }

    public function supportTickets()
    {
        return $this->hasMany(SupportTicket::class, 'user_id');
    }

    public function supportReplies()
    {
        return $this->hasMany(SupportReply::class, 'user_id');
    }

    public function emailLogs()
    {
        return $this->hasMany(EmailLog::class, 'user_id');
    }

    public function smsLogs()
    {
        return $this->hasMany(SmsLog::class, 'user_id');
    }
}
