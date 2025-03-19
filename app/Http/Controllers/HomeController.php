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
        // Fetch Blogs where status is published
        $blogs = Blog::where('status', 'published')->get()->map(function ($blog) use ($locale) {
            return [
                'id' => $blog->id,
                'title' => $locale === 'ar' ? $blog->title_ar : $blog->title_en,
                'content' => $locale === 'ar' ? $blog->content_ar : $blog->content_en,
                'author' => $blog->author,
                'created_at' => $blog->created_at,
                'image' => $blog->image,
            ];
        });
        return view('welcome', compact('subscriptionPackage', 'faqs', 'blogs'));
    }


    public function blogDetails()
    {
        return view('blog-details');
    }
    public function onboarding()
    {
        return view('onBoarding');
    }
}
