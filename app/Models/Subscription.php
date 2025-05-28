<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'contacts_remaining',
        'status',
    ];

    /**
     * Create or update subscription from a successful payment
     */
    public static function createFromPayment(Payment $payment): self
    {
        // Try to find existing active subscription for the user
        $subscription = static::where('user_id', $payment->user_id)
            ->first();

        if ($subscription) {
            // Update existing subscription
            $subscription->update([
                'contacts_remaining' => $subscription->contacts_remaining + $payment->package->contact_limit,
            ]);
            return $subscription;
        }

        // Create new subscription if none exists
        return static::create([
            'user_id'           => $payment->user_id,
            'package_id'        => $payment->package_id,
            'contacts_remaining' => $payment->package->contact_limit,
            'status'            => 'active',
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(SubscriptionPackage::class, 'package_id');
    }

    public function contacts()
    {
        return $this->hasMany(SubscriptionContact::class);
    }

    public function paymentTransactions()
    {
        return $this->hasMany(PaymentTransaction::class);
    }
}