<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\CountriesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DrinkingStatusesController;
use App\Http\Controllers\Admin\EducationalLevelsController;
use App\Http\Controllers\Admin\FeatureController as AdminFeatureController;
use App\Http\Controllers\Admin\LocationsController;
use App\Http\Controllers\Admin\OriginController;
use App\Http\Controllers\Admin\SportsActivitiesController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\MessageSubscriptionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HairColorsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HobbiesController;
use App\Http\Controllers\Admin\PetsController;
use App\Http\Controllers\Admin\SpecializationsController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\MarriageBudgetsController;
use App\Http\Controllers\Admin\ReligionController;
use App\Http\Controllers\Admin\SubscriptionPackageController;
use App\Http\Controllers\Admin\ReligionsController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\FaqsController;

// users web routes
use App\Http\Controllers\User\OnBoardingController;

use App\Models\MarriageBudget;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/on-boarding', [OnBoardingController::class, 'index'])->name('onboarding');
Route::get('/cities-by-country/{countryId}', [OnBoardingController::class, 'getCitiesByCountry'])->name('cities.by.country');

Route::get('/blog-details/{id}', [BlogController::class, 'show'])->name('blog-details');
Route::get('/lang/{locale}', [LocalizationController::class, 'switchLang'])->name('locale.switch');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // admins route
    Route::prefix('admin')->group(function () {
        Route::resource('countries', CountriesController::class);
        Route::resource('origins', OriginController::class);
        Route::resource('sports-activities', SportsActivitiesController::class);
        Route::resource('hair-colors', HairColorsController::class);
        Route::resource('pets', PetsController::class);
        Route::resource('hobbies', HobbiesController::class);
        Route::resource('drinking-statuses', DrinkingStatusesController::class);
        Route::resource('cities', CitiesController::class);
        Route::resource('educational-levels', EducationalLevelsController::class);
        Route::resource('specializations', SpecializationsController::class);
        Route::resource('blogs', BlogController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('features', FeatureController::class);
        Route::resource('subscription-packages', SubscriptionPackageController::class);
        Route::resource('marriage-budgets', MarriageBudgetsController::class);
        Route::resource('religions', ReligionController::class);
        Route::resource('admins', AdminsController::class);
        Route::resource('manageUsers', AdminController::class)->parameters([
            'manageUsers' => 'user' 
        ]);
        Route::resource('faqs', FaqsController::class);
    });

    Route::resource('blogs', BlogController::class);
});
// Route to handle message subscriptions
Route::post('/subscribe-message', [MessageSubscriptionController::class, 'subscribe'])->name('subscribe.message');

require __DIR__ . '/auth.php';
