<?php

use App\Http\Controllers\Api\DynamicDataController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\DrinkingStatusController;
use App\Http\Controllers\Api\FinancialStatusController;
use App\Http\Controllers\Api\GeographicCulturalSocioeconomicController;
use App\Http\Controllers\Api\HobbyController;
use App\Http\Controllers\Api\HousingStatusController;
use App\Http\Controllers\Api\LifestyleInterestsController;
use App\Http\Controllers\Api\MaritalStatusController;
use App\Http\Controllers\Api\OriginController;
use App\Http\Controllers\Api\PersonalAttributesController;
use App\Http\Controllers\Api\PetController;

use App\Http\Controllers\Api\HeightController;
use App\Http\Controllers\Api\ProfessionalEducationalController;
use App\Http\Controllers\Api\ReligiousLevelController;
use App\Http\Controllers\Api\SupportTicketController;
use App\Http\Controllers\Api\WeightController;
use App\Http\Controllers\Api\HairColorController;
use App\Http\Controllers\Api\ReligionController;
use App\Http\Controllers\Api\EducationalLevelController;
use App\Http\Controllers\Api\SportsActivityController;
use App\Http\Controllers\Api\PositionLevelController;
use App\Http\Controllers\Api\SpecializationController;

use App\Http\Controllers\Api\SkinColorController;
use App\Http\Controllers\Api\SmokingToolController;
use App\Http\Controllers\Api\UserProfileController;
use App\Http\Controllers\FCMController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FilterController;
use App\Http\Controllers\Api\GuardianContactVerificationController;
use App\Http\Controllers\Api\LikeController as ApiLikeController;
use App\Http\Controllers\Api\MatchController;
use App\Http\Controllers\Api\PasswordResetController;
use App\Http\Controllers\Api\Tickets\TicketsController;
use App\Http\Controllers\Api\UserPreferenceController as ApiUserPreferenceController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\SubscriptionCardsController;

use App\Http\Controllers\LikeController;
use App\Http\Controllers\User\OnBoardingController;
use App\Http\Controllers\UserPreferenceController;



// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/verify-otp', [AuthController::class, 'verifyOTP']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/password/email', [PasswordResetController::class, 'sendResetOTP'])->middleware('throttle:5,1'); // Rate limit to 5 requests per minute
Route::post('/password/verify-otp', [PasswordResetController::class, 'verifyOTP']);
Route::post('/password/reset', [PasswordResetController::class, 'resetPassword']);
Route::post('/resend-verification-link', [AuthController::class, 'resendVerificationLink']);

// Protected Routes
Route::get('/subscription-cards', [SubscriptionCardsController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/profile', [UserProfileController::class, 'show'])->name('api.profile.show');
    Route::get('/user-profile', [UserProfileController::class, 'getUserWithProfile']);
    // tickets routes
    Route::get('tickets',                [SupportTicketController::class, 'index']);
    Route::post('tickets',                [SupportTicketController::class, 'store']);
    Route::get('tickets/{ticket}',       [SupportTicketController::class, 'show']);
    Route::post('tickets/{ticket}/reply', [SupportTicketController::class, 'reply']);
    Route::post('tickets/{ticket}/close', [SupportTicketController::class, 'close'])
        ->name('api.tickets.close');

    Route::post('/profile', [UserProfileController::class, 'update']);

    Route::get('/religious-levels-gender', [OnBoardingController::class, 'getReligiousLevels']);
    Route::prefix('/guardian-contact')->group(function () {
        Route::post('/send-verification', [GuardianContactVerificationController::class, 'send']);
        Route::post('/verify-code', [GuardianContactVerificationController::class, 'verify']);
        Route::post('/update-guardian-contact', [GuardianContactVerificationController::class, 'updateGuardianContact']);
    });
    //jop-title
    //mariage-buget
    Route::get('/drinking-statuses', [DrinkingStatusController::class, 'index']);
    Route::get('/hair-colors', [HairColorController::class, 'index']);
    Route::get('/religions', [ReligionController::class, 'index']);
    Route::get('/educational-levels', [EducationalLevelController::class, 'index']);
    Route::get('/sports-activities', [SportsActivityController::class, 'index']);
    Route::get('/position-levels', [PositionLevelController::class, 'index']);
    Route::get('/specializations', [SpecializationController::class, 'index']);
    Route::get('/countries', [CountryController::class, 'index']);
    Route::get('/countries/{country}/cities', [CityController::class, 'getCitiesByCountry']);
    Route::get('/hobbies', [HobbyController::class, 'index']);
    Route::get('/pets', [PetController::class, 'index']);
    Route::get('/housing-statuses', [HousingStatusController::class, 'index']);
    Route::get('/marital-statuses', [MaritalStatusController::class, 'index']);
    Route::get('/origins', [OriginController::class, 'index']);
    Route::get('/skin-colors', [SkinColorController::class, 'index']);
    Route::get('/smoking-tools', [SmokingToolController::class, 'index']);
    Route::get('/financial-statuses', [FinancialStatusController::class, 'index']);
    Route::get('/heights', [HeightController::class, 'index']);
    Route::get('/weights', [WeightController::class, 'index']);
    // Group 1: Personal Attributes
    Route::get('/personal-attributes', [PersonalAttributesController::class, 'index']);
    // send notification
    Route::post('/send-notification', [FCMController::class, 'sendNotification']);
    // Group 2: Lifestyle & Interests
    Route::get('/lifestyle-interests', [LifestyleInterestsController::class, 'index']);
    // Group 3: Professional & Educational Background
    Route::get('/professional-educational', [ProfessionalEducationalController::class, 'index']);
    // Group 4: Geographic, Cultural & Socioeconomic Information
    Route::get('/geographic', [GeographicCulturalSocioeconomicController::class, 'index']);
    // Route::get('/user-preferences', [UserPreferenceController::class, 'index']); // List all user preferences
    Route::post('/user-preferences', [ApiUserPreferenceController::class, 'store']); // Create a new user preference

    Route::get('/show-user-preferences', [ApiUserPreferenceController::class, 'show']); // Get a single user preference
    Route::put('/user-preferences/{userPreference}', [ApiUserPreferenceController::class, 'update']); // Update a user preference
    Route::delete('/user-preferences/{userPreference}', [ApiUserPreferenceController::class, 'destroy']); // Delete a user preference
    Route::post('/user/profile/photo', [UserProfileController::class, 'updateProfilePhoto']);
    Route::get('/religious-levels', [ReligiousLevelController::class, 'index']);
    Route::get('/getlikes', [ApiLikeController::class, 'getlikes']);
    Route::delete('/remove-match', [MatchController::class, 'removeMatch']);
    Route::get('/dynamic-data', [DynamicDataController::class, 'index']);
    Route::get('/users/filter', [FilterController::class, 'filterUsers']);
    Route::post('/like', [ApiLikeController::class, 'likeUser']);
    Route::get('/liked-by', [ApiLikeController::class, 'getLikedMe']);
    Route::post('/dislike', [ApiLikeController::class, 'dislikeUser']);
    Route::get('/matches', [MatchController::class, 'getMatches']);
    Route::post('/report-user', [ReportController::class, 'store']);
    Route::post('/reveal-contact', [MatchController::class, 'revealContact'])->name('reveal.contact');
    Route::prefix('guardian-contact')->group(function () {
        Route::post('/send-verification', [GuardianContactVerificationController::class, 'send']);
        Route::post('/verify-code', [GuardianContactVerificationController::class, 'verify']);
    });
});
