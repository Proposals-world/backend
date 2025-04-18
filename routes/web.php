<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\CountriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\DrinkingStatusesController;
use App\Http\Controllers\Admin\EducationalLevelsController;
use App\Http\Controllers\Admin\FeatureController as AdminFeatureController;
use App\Http\Controllers\Admin\LocationsController;
use App\Http\Controllers\Admin\OriginController;
use App\Http\Controllers\Admin\SportsActivitiesController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\MessageSubscriptionController;
// use App\Http\Controllers\ProfileController;
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
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserFeedbackController;
use App\Http\Controllers\Api\UserPreferenceController;
use App\Http\Controllers\Api\UserProfileController;
use App\Http\Controllers\Api\FilterController;

// users web routes
use App\Http\Controllers\User\LikedMeController;
use App\Http\Controllers\User\MatchController;
use App\Http\Controllers\User\OnBoardingController;
use App\Http\Controllers\User\FindMatchController;
use App\Http\Controllers\User\SupportController;
use App\Models\MarriageBudget;
use App\Http\Controllers\HomeController;

// users dashboard routes
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserProfileController as UserUserProfileController;
use App\Models\UserProfile;

Route::get('/main-dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/about-us', function () {
    return view('about-us');
})->name('about-us');


Route::get('/cities-by-country/{countryId}', [OnBoardingController::class, 'getCitiesByCountry'])->name('cities.by.country');
Route::get(
    '/city-locations/{cityId}',
    [OnBoardingController::class, 'getCityLocationsByCity']
)->name('cityLocations.by.city');

Route::get('/blog-details/{id}', [BlogController::class, 'show'])->name('blog-details');
Route::get('/lang/{locale}', [LocalizationController::class, 'switchLang'])->name('locale.switch');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // admins route
    Route::prefix('admin')->group(function () {
        Route::get('/userprofile/{id}', [AdminController::class, 'show'])->name('userprofile');
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
        Route::resource('reports', ReportController::class);
        Route::put('/updateStatus/{id}', [ReportController::class, 'updateStatus'])->name('updateStatus');
    });

    // Route::resource('blogs', BlogController::class);
});



Route::middleware(['auth', 'verified'])->prefix('user')->group(function () {
    // On-boarding page: only accessible if profile is not complete.
    Route::middleware('redirect.if.profile.complete')->group(function () {
        Route::get('/on-boarding', [OnBoardingController::class, 'index'])->name('onboarding');
    });
    Route::post('/profile/update', [OnBoardingController::class, 'updateProfileAndImage'])
        ->name('user.profile.update');
    // Dashboard: only accessible if profile is complete.
    Route::middleware('profile.complete')->group(function () {
        Route::get('/filter', [FilterController::class, 'filterUsers'])
            ->name('users.filter');
        Route::get('/liked-me', [LikedMeController::class, 'index'])->name('liked-me');
        Route::post('/user/like', [LikedMeController::class, 'like'])->name('user.like');
        Route::post('/user/dislike', [LikedMeController::class, 'dislike'])->name('user.dislike');
        Route::get('/support', [SupportController::class, 'index'])->name('user.support');
        Route::post('/feedback/store', [UserFeedbackController::class, 'store'])->name('feedback.store');
        Route::get('/find-match', [FindMatchController::class, 'index'])->name('find-match');
        Route::get('/user-profile', [UserProfileController::class, 'getUserWithProfile']);
        Route::delete('/remove-match', [MatchController::class, 'removeMatch'])->name('api.remove.match');

        Route::get('/matches', [MatchController::class, 'getMatches'])->name('matches');
        Route::get('dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
        Route::get('pricing', [UserDashboardController::class, 'pricing'])->name('user.pricing');
        Route::get('/profile', [UserUserProfileController::class, 'index'])->name('user.profile');
        Route::post('/updateDesiredPartner', [UserPreferenceController::class, 'updateChangedData'])->name('updateDesiredPartner');
        Route::get('/desired', [UserUserProfileController::class, 'desired'])->name('desired');
        Route::get('/profile/update', [UserUserProfileController::class, 'updateProfile'])->name('updateProfile');
        Route::post('/user-preferences', [UserPreferenceController::class, 'store'])
            ->name('api.user-preferences.store');
        Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
        Route::post('/user/profile/photo', [UserProfileController::class, 'updateProfilePhoto'])->name('user.profile.photo.update');

        // Add other routes that require complete profile here.
    });
});



// Route to handle message subscriptions
Route::post('/subscribe-message', [MessageSubscriptionController::class, 'subscribe'])->name('subscribe.message');

require __DIR__ . '/auth.php';
