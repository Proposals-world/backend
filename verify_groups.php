<?php

use App\Models\CountryGroup;
use App\Models\Country;
use App\Models\SubscriptionPackage;
use App\Models\Subscription;
use App\Models\User;

try {
    echo "--- Starting Verification (Final Refactor) ---\n";

    // 1. Create Country Group
    $group = CountryGroup::create([
        'name_en' => 'Test GCC Group',
        'name_ar' => 'Test GCC Group AR',
    ]);
    echo "Created CountryGroup: {$group->name_en} (ID: {$group->id})\n";

    // 2. Link Country
    $country = Country::create([
        'name_en' => 'Test Country',
        'name_ar' => 'Test Country AR',
        'country_group_id' => $group->id,
    ]);
    echo "Created Country linked to Group: {$country->name_en}\n";
    echo "Country belongs to Group: " . ($country->countryGroup->id === $group->id ? 'YES' : 'NO') . "\n";

    // 3. Create Packages
    // 3a. Group Specific Package
    $packageSpecific = SubscriptionPackage::create([
        'package_name_en' => 'Gold GCC',
        'package_name_ar' => 'Gold GCC AR',
        'price' => 100.00,
        'contact_limit' => 50,
        'duration' => 30,
        'gender' => 'male',
        'is_one_time' => false,
        'purchase_count' => 0,
        'country_group_id' => $group->id,
        'is_default' => false,
        'is_special_offer' => false,
    ]);
    echo "Created Specific Package: {$packageSpecific->package_name_en} (Group ID: {$packageSpecific->country_group_id})\n";

    // 3b. Default Global Package
    $packageDefault = SubscriptionPackage::create([
        'package_name_en' => 'Standard Global',
        'package_name_ar' => 'Global AR',
        'price' => 50.00,
        'contact_limit' => 20,
        'duration' => 30,
        'gender' => 'male',
        'is_one_time' => false,
        'purchase_count' => 0,
        'country_group_id' => null,
        'is_default' => true,
        'is_special_offer' => false,
    ]);
    echo "Created Default Package: {$packageDefault->package_name_en} (is_default: " . ($packageDefault->is_default ? 'TRUE' : 'FALSE') . ")\n";

    // 3c. Special Offer Package
    $packageSpecial = SubscriptionPackage::create([
        'package_name_en' => 'Special Ramadan Offer',
        'package_name_ar' => 'Special Ramadan Offer AR',
        'price' => 10.00,
        'contact_limit' => 100,
        'duration' => 30,
        'gender' => 'male',
        'is_one_time' => false,
        'purchase_count' => 0,
        'country_group_id' => null, // Available to all, generally
        'is_default' => false,
        'is_special_offer' => true,
    ]);
    echo "Created Special Offer Package: {$packageSpecial->package_name_en} (is_special_offer: " . ($packageSpecial->is_special_offer ? 'TRUE' : 'FALSE') . ")\n";


    // 4. Test Finding Special Offer
    $foundSpecial = SubscriptionPackage::specialOffer()->first();
    echo "Found Special Offer query result: " . ($foundSpecial ? $foundSpecial->package_name_en : 'NONE') . "\n";

    // Cleanup
    $packageSpecific->delete();
    $packageDefault->delete();
    $packageSpecial->delete();
    $country->delete();
    $group->delete();

    echo "--- Verification Complete ---\n";

} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
