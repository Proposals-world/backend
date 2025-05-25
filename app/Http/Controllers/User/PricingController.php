<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPackage;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
        $lang = $this->getAppLocale();
        $subscriptionCards = $this->getSubscriptionCards($lang); // Changed from $package to $subscriptionCards

        return view('user.pricing.index', compact('subscriptionCards')); // Pass subscriptionCards
    }

    private function getAppLocale()
    {
        return app()->getLocale();
    }

    private function getSubscriptionCards($lang)
    {
        return SubscriptionPackage::all()->map(function ($package) use ($lang) {
            return [
                'id' => $package->id,
                'package_name' => $lang === 'ar' ? $package->package_name_ar : $package->package_name_en,
                'price' => $package->price,
                'contact_limit' => $package->contact_limit,
            ];
        });
    }
}