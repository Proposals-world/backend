<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Faq;
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
        // Fetch FAQs
        $faqs = Faq::all()->map(function ($faq) use ($locale) {
            return [
                'question' => $locale === 'ar' ? $faq->question_ar : $faq->question_en,
                'answer' => $locale === 'ar' ? $faq->answer_ar : $faq->answer_en,
            ];
        });
        return view('welcome', compact('subscriptionPackage', 'faqs'));
    }


    public function blogDetails(Blog $blog)
    {
        $locale = app()->getLocale();
        return view('blog-details', compact('blog', 'locale'));
    }
}
