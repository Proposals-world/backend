<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\CountriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\DrinkingStatusesController;
use App\Http\Controllers\Admin\EducationalLevelsController;
use App\Http\Controllers\Admin\OriginController;
use App\Http\Controllers\Admin\SportsActivitiesController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\MessageSubscriptionController;
// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\SupportTicketController;
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
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\FaqsController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserFeedbackController;
use App\Http\Controllers\Api\UserPreferenceController;
use App\Http\Controllers\Api\UserProfileController;
use App\Http\Controllers\Api\FilterController;
use App\Http\Controllers\Api\GuardianContactVerificationController;
// users web routes
use App\Http\Controllers\User\LikedMeController;
use App\Http\Controllers\User\MatchController;
use App\Http\Controllers\User\OnBoardingController;
use App\Http\Controllers\User\FindMatchController;
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
        Route::get('/user-profile', [UserProfileController::class, 'getUserWithProfile']);

        Route::put('/updateStatus/{id}', [ReportController::class, 'updateStatus'])->name('updateStatus');
        Route::put('/deactivate/{id}', [AdminsController::class, 'deactivate'])->name('deactivate');
        Route::put('/active/{id}', [AdminsController::class, 'active'])->name('active');
    });

    // Route::resource('blogs', BlogController::class);
});
Route::middleware(['auth', 'verified'])->prefix('user')->group(function () {
    Route::middleware('redirect.if.profile.complete')->group(function () {
        Route::get('/on-boarding', [OnBoardingController::class, 'index'])->name('onboarding');
    });

    // Guardian verification should only happen AFTER profile is complete
    Route::post('/profile/update', [OnBoardingController::class, 'updateProfileAndImage'])
        ->name('user.profile.update');
});
Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/religious-levels-gender', [OnBoardingController::class, 'getReligiousLevels'])->name('religious.levels.gender');
});

// User dashboard and match routes
Route::middleware([
    'auth',
    'verified',
    'check.status',
    'profile.complete',         // First: ensure profile complete
    'guardian.verified'         // Second: ensure guardian verified
])->prefix('user')->group(function () {
    Route::get('/filter', [FilterController::class, 'filterUsers'])->name('users.filter');
    Route::get('/liked-me', [LikedMeController::class, 'index'])->name('liked-me');
    Route::post('/user/like', [LikedMeController::class, 'like'])->name('user.like');
    Route::post('/user/dislike', [LikedMeController::class, 'dislike'])->name('user.dislike');

    // Support tickets
    Route::get('/support-tickets', [SupportTicketController::class, 'index'])->name('user.support');
    Route::post('support-tickets', [SupportTicketController::class, 'store'])->name('user.support.store');
    Route::get('support-tickets/{ticket}', [SupportTicketController::class, 'show'])->name('user.support.show');
    Route::get('support-tickets/create', [SupportTicketController::class, 'create'])->name('user.support.create');
    Route::post('/{ticket}/reply', [SupportTicketController::class, 'reply'])->name('user.support.reply');
    Route::post('/{ticket}/close', [SupportTicketController::class, 'close'])->name('user.support.close');

    // Other protected routes
    Route::post('/feedback/store', [UserFeedbackController::class, 'store'])->name('feedback.store');
    Route::get('/find-match', [FindMatchController::class, 'index'])->name('find-match');
    Route::get('/user-profile', [UserProfileController::class, 'getUserWithProfile']);
    Route::delete('/remove-match', [MatchController::class, 'removeMatch'])->name('api.remove.match');
    Route::get('/matches', [MatchController::class, 'index'])->name('matches');
    Route::get('/get-matches', [MatchController::class, 'getMatches'])->name('getMatchesApi');
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('pricing', [UserDashboardController::class, 'pricing'])->name('user.pricing');
    Route::get('/profile', [UserUserProfileController::class, 'index'])->name('user.profile');
    Route::post('/updateDesiredPartner', [UserPreferenceController::class, 'updateChangedData'])->name('updateDesiredPartner');
    Route::get('/desired', [UserUserProfileController::class, 'desired'])->name('desired');
    Route::get('/profileUser/update', [UserUserProfileController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/user-preferences', [UserPreferenceController::class, 'store'])->name('api.user-preferences.store');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::post('/user/profile/photo', [UserProfileController::class, 'updateProfilePhoto'])->name('user.profile.photo.update');
    Route::post('/reveal-contact', [MatchController::class, 'revealContact'])->name('reveal.contact');
    Route::post('/report-user', [ReportController::class, 'store']);
    Route::get('/verify-guardian-otp', function () {
        return view('verify-guardian-otp');
    })->name('verify.guardian.otp');
});
Route::prefix('user/guardian-contact')->group(function () {
    Route::post('/send-verification', [GuardianContactVerificationController::class, 'send']);
    Route::post('/verify-code', [GuardianContactVerificationController::class, 'verify']);
    Route::post('/update-guardian-contact', [GuardianContactVerificationController::class, 'updateGuardianContact']);
});


// Route to handle message subscriptions
Route::post('/subscribe-message', [MessageSubscriptionController::class, 'subscribe'])->name('subscribe.message');

require __DIR__ . '/auth.php';
