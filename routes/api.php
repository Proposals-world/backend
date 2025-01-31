<?php

use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\Api\DrinkingStatusController;
use App\Http\Controllers\API\FinancialStatusController;
use App\Http\Controllers\API\HobbyController;
use App\Http\Controllers\API\HousingStatusController;
use App\Http\Controllers\API\MaritalStatusController;
use App\Http\Controllers\API\OriginController;
use App\Http\Controllers\API\PetController;

use App\Http\Controllers\Api\HeightController;
use App\Http\Controllers\Api\WeightController;
use App\Http\Controllers\API\HairColorController;
use App\Http\Controllers\API\ReligionController;
use App\Http\Controllers\API\EducationalLevelController;
use App\Http\Controllers\API\SportsActivityController;
use App\Http\Controllers\API\PositionLevelController;
use App\Http\Controllers\API\SpecializationController;

use App\Http\Controllers\API\SkinColorController;
use App\Http\Controllers\API\SmokingToolController;
use App\Http\Controllers\Api\UserProfileController;
use App\Http\Controllers\FCMController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PasswordResetController;
use App\Http\Controllers\Api\Tickets\TicketsController;

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/verify-otp', [AuthController::class, 'verifyOTP']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/password/email', [PasswordResetController::class, 'sendResetOTP'])->middleware('throttle:5,1'); // Rate limit to 5 requests per minute
Route::post('/password/verify-otp', [PasswordResetController::class, 'verifyOTP']);
Route::post('/password/reset', [PasswordResetController::class, 'resetPassword']);
Route::post('/resend-verification-link', [AuthController::class, 'resendVerificationLink']);

// Protected Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/profile', [UserProfileController::class, 'show'])->name('api.profile.show');
    // tickets routes
    Route::get('/all-tickets', [TicketsController::class, 'getTickets']);
    Route::post('/create-ticket', [TicketsController::class, 'createTicket']);
    Route::post('/reply-ticket', [TicketsController::class, 'ticketsReply']);
    Route::get('/get-ticket-with-replies', [TicketsController::class, 'getTicketWithReplies']);
    Route::post('/update-ticket-status', [TicketsController::class, 'updateTicketStatus']);   
    
    
    Route::post('/profile', [UserProfileController::class, 'update']);

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
});


Route::post('/send-notification', [FCMController::class, 'sendNotification']);

