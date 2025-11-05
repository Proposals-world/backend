<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'date',
        'email',
        'status',
        'package_id',
        'reference_number',
        'final_amount',
        'payment_type',
        'photo_url',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function package()
    {
        return $this->belongsTo(SubscriptionPackage::class, 'package_id');
    }
}
