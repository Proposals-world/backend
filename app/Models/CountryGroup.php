<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryGroup extends Model
{
    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    protected $casts = [
    ];

    public function countries()
    {
        return $this->hasMany(Country::class);
    }

    public function subscriptionPackages()
    {
        return $this->hasMany(SubscriptionPackage::class);
    }

}
