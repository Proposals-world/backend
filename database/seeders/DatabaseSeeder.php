<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            // Existing Seeders
            RoleSeeder::class,
            UserSeeder::class,
            NationalitiesTableSeeder::class,
            ReligionsTableSeeder::class,
            OriginsTableSeeder::class,
            CountriesTableSeeder::class,
            CitiesTableSeeder::class,
            EducationalLevelsTableSeeder::class,
            SpecializationsTableSeeder::class,
            JobTitlesTableSeeder::class,
            SectorsTableSeeder::class,
            PositionLevelsTableSeeder::class,
            FinancialStatusesTableSeeder::class,
            HousingStatusesTableSeeder::class,
            HeightsTableSeeder::class,
            WeightsTableSeeder::class,
            MaritalStatusesTableSeeder::class,
            SkinColorsTableSeeder::class,
            ZodiacSignsTableSeeder::class,
            HairColorsTableSeeder::class,
            ReligiosityLevelsSeeder::class,
            SleepHabitsSeeder::class,
            SmokingToolsTableSeeder::class,
            DrinkingStatusesTableSeeder::class,
            SportsActivitiesTableSeeder::class,
            SocialMediaPresencesTableSeeder::class,
            MarriageBudgetsTableSeeder::class,
            PetsTableSeeder::class,
            UserPetsTableSeeder::class,
            HobbiesTableSeeder::class,
            UserHobbiesTableSeeder::class,
            UserProfilesTableSeeder::class,
            UserAgreementsTableSeeder::class,
            UserPreferencesTableSeeder::class,
            UserPreferredLanguagesTableSeeder::class,
            UserPreferredPetsTableSeeder::class,
            UserMatchesTableSeeder::class,
            SubscriptionPackagesTableSeeder::class,
            SubscriptionsTableSeeder::class,
            SubscriptionContactsTableSeeder::class,
            UserSmokingToolPivotsTableSeeder::class,
            UserReportsTableSeeder::class,
            UserBlocksTableSeeder::class,
            SuccessStoriesTableSeeder::class,
            UserFeedbackTableSeeder::class,
            SeoSettingsTableSeeder::class,
            CmsContentsTableSeeder::class,
            UserLogsTableSeeder::class,
            LocationsTableSeeder::class,
            UserPhotosTableSeeder::class,
            SmokingToolsSeeder::class,
            FeatureSeeder::class,
            FaqSeeder::class,
            CategorySeeder::class,
            BlogSeeder::class,
            EyeColorSeeder::class,
        ]);
    }
}
