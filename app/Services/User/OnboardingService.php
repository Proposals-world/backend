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
use App\Models\EyeColor;
use App\Models\ReligiosityLevel;
use Illuminate\Support\Facades\DB;

class OnboardingService
{
    /**
     * Retrieve onboarding data with the name field selected according to the current locale,
     * along with the authenticated user's gender.
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

        // Get the authenticated user's gender (if available).
        $userGender = auth()->check() ? auth()->user()->gender : null;

        // Get religious levels based on the authenticated user's gender.
        $religiousLevels = collect([]);
        if ($userGender) {
            // Convert gender: 'male' maps to 1 and 'female' maps to 2
            $genderValue = $userGender === 'male' ? 1 : 2;
            $religiousLevels = ReligiosityLevel::select('id', DB::raw("{$nameField} as name"))
                ->where('gender', $genderValue)
                ->get();
        }

        return [
            'gender'            => $userGender,
            'hairColors'        => $getData(HairColor::class),
            'heights'           => $getData(Height::class),
            'weights'           => $getData(Weight::class),
            'origins'           => $getData(Origin::class),
            'maritalStatuses'   => $getData(MaritalStatus::class),
            'skinColors'        => $getData(SkinColor::class),
            'zodiacSigns'       => $getData(ZodiacSign::class),
            'sleepHabits'       => $getData(SleepHabit::class),
            // For MarriageBudget, pass the specific field.
            'eyeColors'    => $getData(EyeColor::class),
            'marriageBudget'    => $getData(MarriageBudget::class, $budgetField),
            'jobTitles'         => $getData(JobTitle::class),
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
            'religiousLevels'   => $religiousLevels,
        ];
    }
    public function getSpecificReligiousLevels($religionId, $gender)
    {
        $locale = app()->getLocale();
        $nameField = $locale === 'ar' ? 'name_ar' : 'name_en';

        $query = ReligiosityLevel::select('id', DB::raw("{$nameField} as name"))
            ->where('gender', $gender);

        // Apply ID filters only if gender = 2
        if ($gender == 2) {
            if ($religionId == 1) {
                $query->whereBetween('id', [6, 10]);
            } elseif ($religionId == 2) {
                $query->whereBetween('id', [11, 14]);
            }
        }

        $religiousLevels = $query->get();

        return response()->json([
            'religiousLevels' => $religiousLevels,
        ]);
    }
}
