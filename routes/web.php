<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\CountriesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DrinkingStatusesController;
use App\Http\Controllers\Admin\EducationalLevelsController;
use App\Http\Controllers\admin\FeatureController as AdminFeatureController;
use App\Http\Controllers\Admin\LocationsController;
use App\Http\Controllers\Admin\OriginController;
use App\Http\Controllers\Admin\SportsActivitiesController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\MessageSubscriptionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HairColorsController;
use App\Http\Controllers\Admin\HobbiesController;
use App\Http\Controllers\Admin\PetsController;
use App\Http\Controllers\Admin\SpecializationsController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\MarriageBudgetsController;
use App\Http\Controllers\Admin\ReligionController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\admin\SubscriptionPackageController;
use App\Http\Controllers\admin\ReligionsController;
// use App\Http\Controllers\AdminUserController;
use App\Models\MarriageBudget;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/blog-details/{blog}', [HomeController::class, 'blog-details'])->name('blog-details');

Route::get('/lang/{locale}', [LocalizationController::class, 'switchLang'])->name('locale.switch');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // admins route
    Route::resource('admin/countries', CountriesController::class);
    Route::resource('admin/origins', OriginController::class);
    Route::resource('admin/sports-activities', SportsActivitiesController::class);
    Route::resource('admin/hair-colors', HairColorsController::class);
    Route::resource('admin/pets', PetsController::class);
    Route::resource('admin/hobbies', HobbiesController::class);
    Route::resource('admin/drinking-statuses', DrinkingStatusesController::class);
    Route::resource('admin/cities', CitiesController::class);
    Route::resource('admin/educational-levels', EducationalLevelsController::class);
    Route::resource('admin/specializations', SpecializationsController::class);


    Route::resource('admin/features', FeatureController::class);
    Route::resource('admin/subscription-packages', SubscriptionPackageController::class);
    Route::resource('admin/marriage-budgets', MarriageBudgetsController::class);
    Route::resource('admin/religions', ReligionController::class);
    Route::resource('admin/manageAdmins', AdminController::class);
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('blogs', BlogController::class);
});
// Route to handle message subscriptions
Route::post('/subscribe-message', [MessageSubscriptionController::class, 'subscribe'])->name('subscribe.message');

require __DIR__ . '/auth.php';
