<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Subscription;
use App\Models\SubscriptionPackage;
use App\Services\FintesaPaymentService;
use Illuminate\Support\Facades\Auth;

class PaymentPageController extends Controller
{
    public function pricing(FintesaPaymentService $paymentService)
    {
        $lang = app()->getLocale();
        $user = Auth::user()->profile;
        $isMale = Auth::check() && (Auth::user()->gender === 'male');
        // Get user's country group
        $user = Auth::user();

        $countryId = $user->country_of_residence_id ?? $user->profile?->country_of_residence_id;

        $countryGroupId = $countryId ? Country::where('id', $countryId)->value('country_group_id') : null;

        // dd($countryGroupId);
        $packages = SubscriptionPackage::query()
            ->where('id', '!=', 999)
            ->where('id', '!=', 1000)
            ->when($isMale, fn($q) => $q->where('gender', 'male'))
            ->when(!$isMale, fn($q) => $q->where('gender', 'female'))
            ->where('country_group_id', $countryGroupId)
            // ->when(!$countryGroupId, fn($q) => $q->where('is_default', true))
            ->orderBy('id')
            ->get();
        // dd($packages);
        // If no packages for this country group, fallback to default packages
        if ($packages->isEmpty()) {
            $packages = SubscriptionPackage::query()
                ->where('id', '!=', 999)
                ->where('id', '!=', 1000)
                ->when($isMale, fn($q) => $q->where('gender', 'male'))
                ->when(!$isMale, fn($q) => $q->where('gender', 'female'))
                ->where('is_default', true)
                ->orderBy('id')
                ->get();
        }
        // dd($packages);
        $subscriptionCards = $packages->map(function (SubscriptionPackage $package) use ($lang, $paymentService) {
            $paymentUrl = $package->payment_url;

            // Lazy sync: if neither payment_url nor product_id exist, create the product now
            if (empty($paymentUrl) && empty($package->fintesa_product_id)) {
                $create = $paymentService->createProduct($package);
                if (($create['ok'] ?? false)) {
                    $package->fintesa_product_id = $create['product_id'] ?? null;
                    $package->fintesa_price_id = $create['price_id'] ?? null;
                    if (!empty($create['payment_url'])) {
                        $package->payment_url = $create['payment_url'];
                    }
                    $package->save();
                    $paymentUrl = $package->payment_url;
                }
            }

            // Fallback: try deriving a payment URL if product id exists but no stored URL
            if (empty($paymentUrl)) {
                $url = $paymentService->getPaymentUrl($package);
                if (($url['ok'] ?? false) && !empty($url['payment_url'])) {
                    $paymentUrl = $url['payment_url'];
                }
            }

            return [
                'id'         => $package->id,
                'package_name'  => $lang === 'ar' ? $package->package_name_ar : $package->package_name_en,
                'price'         => $package->price,
                'contact_limit' => $package->contact_limit,
                'duration'      => $package->duration,
                'payment_url'   => $paymentUrl,
                'gender'        => $package->gender,
                'is_default'    => $package->is_default,
                'country_group_id' => $package->country_group_id,
                'is_special_offer' => $package->is_special_offer,

            ];
        });
        $activePackageId = Subscription::where('user_id', Auth::id())
            ->where('status', 'active')
            ->value('package_id');
        $activeSubscription = Subscription::where('user_id', Auth::id())
            ->where('status', 'active')
            ->first();

        return view('user.pricing', compact('subscriptionCards', 'packages', 'activePackageId', 'activeSubscription'));
    }

    public function success()
    {
        return view('payment.success');
    }

    public function fail()
    {
        return view('payment.error');
    }
}
