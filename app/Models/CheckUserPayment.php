<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckUserPayment extends Model
{
    use HasFactory;

    protected $table = 'check_user_payments';

    protected $fillable = [
        'user_id',
        'package_id',
        'email',
        'amount',
        'date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(SubscriptionPackage::class, 'package_id');
    }
}
