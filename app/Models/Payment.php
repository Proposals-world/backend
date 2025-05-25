<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'order_id',
        'transaction_id',
        'amount',
        'currency',
        'status',
        'gateway_response_code',
        'gateway_response',
        'paid_at'
    ];

    protected $casts = [
        'gateway_response' => 'array',
        'paid_at' => 'datetime'
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'order_id';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(SubscriptionPackage::class, 'package_id');
    }
}