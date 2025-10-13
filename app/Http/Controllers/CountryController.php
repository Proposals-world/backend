<?php

namespace App\Http\Controllers;

use App\Helpers\CountryHelper;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $locale = $request->get('locale'); // optional override
        $countries = CountryHelper::getCountries($locale);

        return response()->json([
            'locale' => $locale ?? app()->getLocale(),
            'countries' => $countries,
        ]);
    }
}
