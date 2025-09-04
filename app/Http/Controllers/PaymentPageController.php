<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPackage;
use App\Services\FintesaPaymentService;
use Illuminate\Support\Facades\Auth;

class PaymentPageController extends Controller
{
    public function pricing(FintesaPaymentService $paymentService)
    {
        $lang = app()->getLocale();
        $isMale = Auth::check() && (Auth::user()->gender === 'male');

        $packages = SubscriptionPackage::query()
            ->when($isMale, fn($q) => $q->where('gender', 'male'))
            ->when(!$isMale, fn($q) => $q->where('gender', 'female'))
            ->orderBy('id')
            ->get();

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
                'package_name'  => $lang === 'ar' ? $package->package_name_ar : $package->package_name_en,
                'price'         => $package->price,
                'contact_limit' => $package->contact_limit,
                'duration'      => $package->duration,
                'payment_url'   => $paymentUrl,
                'gender'        => $package->gender,
            ];
        });

        return view('user.pricing', compact('subscriptionCards'));
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

