<?php

namespace App\Services\User;

use App\Models\HairColor;
use App\Models\Height;
use App\Models\Weight;
use App\Models\Origin;
use App\Models\MaritalStatus;
use App\Models\SkinColor;
use App\Models\ZodiacSign;
use App\Models\SleepHabit;
use App\Models\MarriageBudget;
use App\Models\Hobby;
use App\Models\JobTitle;
use App\Models\Pet;
use App\Models\SportsActivity;
use App\Models\DrinkingStatus;
use App\Models\Country;
use App\Models\Religion;
use App\Models\Nationality;
use App\Models\HousingStatus;
use App\Models\FinancialStatus;
use App\Models\Specialization;
use App\Models\PositionLevel;
use App\Models\EducationalLevel;
use App\Models\SmokingTool;
use App\Models\SocialMediaPresence;


use Illuminate\Support\Facades\DB;

class OnboardingService
{
    /**
     * Retrieve onboarding data with the name field selected according to the current locale.
     *
     * @return array
     */
    public function getOnboardingData()
    {
        $locale = app()->getLocale();
        // For most models we use these columns:
        $nameField = $locale === 'ar' ? 'name_ar' : 'name_en';
        // For MarriageBudget, the columns are different:
        $budgetField = $locale === 'ar' ? 'budget_ar' : 'budget_en';

        // Helper closure to avoid repetition.
        // Optionally, a specific field can be provided.
        $getData = function ($model, $field = null) use ($nameField) {
            $column = $field ?: $nameField;
            return $model::select('id', DB::raw("{$column} as name"))->get();
        };

        return [
            'hairColors'        => $getData(HairColor::class),
            'heights'           => $getData(Height::class),
            'weights'           => $getData(Weight::class),
            'origins'           => $getData(Origin::class),
            'maritalStatuses'   => $getData(MaritalStatus::class),
            'skinColors'        => $getData(SkinColor::class),
            'zodiacSigns'       => $getData(ZodiacSign::class),
            'sleepHabits'       => $getData(SleepHabit::class),
            // For MarriageBudget, pass the specific field.
            'marriageBudget'    => $getData(MarriageBudget::class, $budgetField),
            'jobTitles'    => $getData(JobTitle::class),
            'hobbies'           => $getData(Hobby::class),
            'pets'              => $getData(Pet::class),
            'sportsActivities'  => $getData(SportsActivity::class),
            'smokingTools'      => $getData(SmokingTool::class),
            'drinkingStatuses'  => $getData(DrinkingStatus::class),
            'countries'         => $getData(Country::class),
            'religions'         => $getData(Religion::class),
            'nationalities'     => $getData(Nationality::class),
            'housingStatuses'   => $getData(HousingStatus::class),
            'financialStatuses' => $getData(FinancialStatus::class),
            'specializations'   => $getData(Specialization::class),
            'positionLevels'    => $getData(PositionLevel::class),
            'educationalLevels' => $getData(EducationalLevel::class),
            'socialMediaPresence' => $getData(SocialMediaPresence::class),
        ];
    }


    /**
     * Retrieve cities based on the given country ID.
     *
     * @param int $countryId
     * @return \Illuminate\Http\JsonResponse
     */

}