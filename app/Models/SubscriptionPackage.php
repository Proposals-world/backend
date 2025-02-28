<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_name_en',
        'package_name_ar',
        'price',
        'duration_days',
        'contact_limit',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'package_id');
    }
    public function features()
    {
        // return $this->belongsToMany(Feature::class, 'feature_subscription_package', 'subscription_package_id ', 'feature_id ');

        return $this->belongsToMany(Feature::class)
            ->withPivot('included')
            ->withTimestamps();
    }
}
