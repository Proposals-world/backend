<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPackage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $locale = app()->getLocale();
        $subscriptionPackage = SubscriptionPackage::all()->map(function ($package) use ($locale) {
            return [
                'package_name' => $locale === 'ar' ? $package->package_name_ar : $package->package_name_en,
                'price' => $package->price,
                'duration_days' => $package->duration_days,
                'contact_limit' => $package->contact_limit,
            ];
        });
        return view('welcome', compact('subscriptionPackage'));
    }


    public function blogDetails()
    {
        return view('blog-details');
    }
}
