<?php
// config/countries.php

use libphonenumber\PhoneNumberUtil;

$phoneUtil = PhoneNumberUtil::getInstance();

// Detect app locale (you can also use request()->getPreferredLanguage() if needed)
// $locale = app()->getLocale();
// dd($locale);
// Load country names based on locale
// if ($locale === 'ar') {
//     $all = require base_path('vendor/umpirsky/country-list/data/ar/country.php');
// } else {
// }
$all = require base_path('vendor/umpirsky/country-list/data/en/country.php');

$list = [];

foreach ($all as $iso => $name) {
    $code = $phoneUtil->getCountryCodeForRegion($iso);

    // Skip countries without dialing codes (e.g., AQ - Antarctica)
    if (!$code) {
        continue;
    }

    $list[$iso] = [
        'name'      => $name,
        'dial_code' => '+' . $code,
    ];
}
// dd($list);
return $list;
