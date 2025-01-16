<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPackage extends Model
{
    use HasFactory;

    protected $primaryKey = 'package_id';

    protected $fillable = [
        'package_name_en',
        'package_name_ar',
        'features_en',
        'features_ar',
        'price',
        'duration_days',
        'contact_limit',
    ];

    // Relationships
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'package_id');
    }
}
