<?php

namespace App\Helpers;

use libphonenumber\PhoneNumberUtil;
use Illuminate\Support\Facades\Cache;

class CountryHelper
{
    public static function getCountries(string $locale = null, int $cacheSeconds = 3600): array
    {
        $locale = $locale ?? app()->getLocale() ?? 'en';
        $cacheKey = "countries_list_{$locale}";

        return Cache::remember($cacheKey, $cacheSeconds, function () use ($locale) {
            $phoneUtil = PhoneNumberUtil::getInstance();
            $path = base_path("vendor/umpirsky/country-list/data/{$locale}/country.php");

            if (!file_exists($path)) {
                $path = base_path('vendor/umpirsky/country-list/data/en/country.php');
            }

            $all = require $path;
            $list = [];

            foreach ($all as $iso => $name) {
                $code = $phoneUtil->getCountryCodeForRegion(strtoupper($iso));
                if (!$code) continue;

                $list[$iso] = [
                    'name'      => $name,
                    'dial_code' => '+' . $code,
                ];
            }

            return $list;
        });
    }
}
