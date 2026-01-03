<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\CountryGroup;
use App\Models\Faq;
use App\Models\SubscriptionPackage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $locale = app()->getLocale();
        // dropdown groups
        $countryGroups = CountryGroup::all()->map(function ($group) use ($locale) {
            return [
                'id' => $group->id,
                'name' => $locale === 'ar' ? $group->name_ar : $group->name_en,
            ];
        });
        $selectedGroupId = request('country_group_id'); // dropdown value

        // =======================
        // MALE PACKAGES
        // =======================
        $malePackagesQuery = SubscriptionPackage::query()
            ->whereNotIn('id', [999, 1000])
            ->where('gender', 'male');

        // if no group selected => show only default
        if (!$selectedGroupId) {
            $malePackagesQuery->where('is_default', true);
        } else {
            $malePackagesQuery->where('country_group_id', $selectedGroupId);

            // fallback if empty
            if (!$malePackagesQuery->exists()) {
                $malePackagesQuery = SubscriptionPackage::query()
                    ->whereNotIn('id', [999, 1000])
                    ->where('gender', 'male')
                    ->where('is_default', true);
            }
        }

        $malePackages = $malePackagesQuery->orderBy('id')->get();


        // =======================
        // FEMALE PACKAGES
        // =======================
        $femalePackagesQuery = SubscriptionPackage::query()
            ->whereNotIn('id', [999, 1000])
            ->where('gender', 'female');

        if (!$selectedGroupId) {
            $femalePackagesQuery->where('is_default', true);
        } else {
            $femalePackagesQuery->where('country_group_id', $selectedGroupId);

            if (!$femalePackagesQuery->exists()) {
                $femalePackagesQuery = SubscriptionPackage::query()
                    ->whereNotIn('id', [999, 1000])
                    ->where('gender', 'female')
                    ->where('is_default', true);
            }
        }

        $femalePackages = $femalePackagesQuery->orderBy('id')->get();

        // Fetch FAQs
        $faqs = Faq::all()->map(function ($faq) use ($locale) {
            return [
                'question' => $locale === 'ar' ? $faq->question_ar : $faq->question_en,
                'answer' => $locale === 'ar' ? $faq->answer_ar : $faq->answer_en,
            ];
        });
        // Fetch Blogs where status is published
        $blogs = Blog::where('status', 'published')
            ->latest()
            ->take(6)
            ->get()
            ->map(function ($blog) use ($locale) {
                return [
                    'id' => $blog->id,
                    'title' => $locale === 'ar' ? $blog->title_ar : $blog->title_en,
                    'content' => $locale === 'ar' ? $blog->content_ar : $blog->content_en,
                    'author' => $blog->author,
                    'created_at' => $blog->created_at,
                    'image' => $blog->image,
                ];
            });
        return view('welcome', compact(
            'malePackages',
            'femalePackages',
            'faqs',
            'blogs',
            'countryGroups',
            'selectedGroupId'
        ));
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
