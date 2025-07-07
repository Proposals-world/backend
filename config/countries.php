<?php
// config/countries.php

use libphonenumber\PhoneNumberUtil;

$phoneUtil = PhoneNumberUtil::getInstance();

// load Umpirsky’s English‐names array
$all = require base_path('vendor/umpirsky/country-list/data/en/country.php');

$list = [];
foreach ($all as $iso => $name) {
    // fetch the country calling code, e.g. “962” for “JO”
    $code = $phoneUtil->getCountryCodeForRegion($iso);

    // skip entries without metadata (e.g. AQ / Antarctica has no dialing code)
    if (!$code) {
        continue;
    }

    $list[$iso] = [
        'name'      => $name,
        'dial_code' => '+' . $code,
    ];
}

return $list;
