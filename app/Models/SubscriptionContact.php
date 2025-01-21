<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id',
        'contact_user_id',
        'accessed_at',
    ];

    // Relationships
    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }

    public function contactUser()
    {
        return $this->belongsTo(User::class, 'contact_user_id');
    }
}
