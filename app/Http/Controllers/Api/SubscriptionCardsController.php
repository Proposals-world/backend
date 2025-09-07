<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionPackage;

class SubscriptionCardsController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->header('Accept-Language', 'en');

        $subscriptionCards = SubscriptionPackage::all()->map(function ($package) use ($lang) {
            // dd($package)->gender;
            if ($package->gender == "male") {

                return [
                    'package_name'   => $lang === 'ar' ? $package->package_name_ar : $package->package_name_en,
                    'price'          => $package->price,
                    'contact_limit'  => $package->contact_limit,
                    // 'duration'  => $package->duration,
                ];
            } else {
                return [
                    'package_name'   => $lang === 'ar' ? $package->package_name_ar : $package->package_name_en,
                    'price'          => $package->price,
                    // 'contact_limit'  => $package->contact_limit,
                    'duration'  => $package->duration,
                ];
            }
        });

        return response()->json([
            'status' => 'success',
            'data'   => $subscriptionCards,
        ]);
    }
}
