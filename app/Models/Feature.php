<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    /**
     * The subscription packages that belong to the feature.
     */
    public function subscriptionPackages()
    {
        // return $this->belongsToMany(SubscriptionPackage::class, 'feature_subscription_package', 'subscription_package_id ', 'feature_id ');

        return $this->belongsToMany(SubscriptionPackage::class)
            ->withPivot('included')
            ->withTimestamps();
    }
}
