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
        'contact_limit',
        'duration',
        'gender',
        'is_one_time',
        'fintesa_product_id',
        'fintesa_price_id',
        'payment_url',
        'purchase_count',
    ];
    protected $casts = [
        'is_one_time' => 'boolean',
        'duration' => 'integer',
        'contact_limit' => 'integer',
        'price' => 'decimal:2',
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

    public function generatePaymentUrl(): ?string
    {
        if (!$this->fintesa_product_id) {
            return null;
        }
        $baseUrl = config('services.fintesa.base_url');
        $successUrl = config('services.fintesa.success_url');
        return rtrim($baseUrl, '/') . '/checkout/' . $this->fintesa_product_id . '?success_url=' . urlencode($successUrl) . '&metadata[package_id]=' . $this->id;
    }

    public function syncWithFintesa(): void
    {
        app(\App\Services\FintesaPaymentService::class);
        // Intentionally left as a hint; actual syncing done in controller/service flow
    }
    public function payments()
    {
        return $this->hasMany(UserPayment::class, 'package_id');
    }
}
