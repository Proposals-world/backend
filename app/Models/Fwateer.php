<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fwateer extends Model
{
    use HasFactory;

    protected $table = 'fwateer';

    protected $fillable = [
        'company_name',
        'company_address',
        'trade_reg_number',
        'sales_tax_number',
        'invoice_date',
        'invoice_number',
        'user_id',
        'amount',
        'package_id',
        'payment_method',
    ];

    protected $casts = [
        'invoice_date' => 'date', // 👈 important fix
    ];
    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function package()
    {
        return $this->belongsTo(SubscriptionPackage::class, 'package_id');
    }
}
