<?php

use App\Http\Controllers\Admin\CountriesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DrinkingStatusesController;
use App\Http\Controllers\Admin\LocationsController;
use App\Http\Controllers\Admin\OriginController;
use App\Http\Controllers\Admin\SportsActivitiesController;
use App\Http\Controllers\MessageSubscriptionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HairColorsController;
use App\Http\Controllers\Admin\HobbiesController;
use App\Http\Controllers\Admin\PetsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// admins route
Route::resource('admin/countries', CountriesController::class);
Route::resource('admin/origins', OriginController::class);
Route::resource('admin/sports-activities', SportsActivitiesController::class);
Route::resource('admin/hair-colors', HairColorsController::class);
Route::resource('admin/pets', PetsController::class);
Route::resource('admin/hobbies', HobbiesController::class);
Route::resource('admin/drinking-statuses', DrinkingStatusesController::class);



// Route to handle message subscriptions
Route::post('/subscribe-message', [MessageSubscriptionController::class, 'subscribe'])->name('subscribe.message');

require __DIR__ . '/auth.php';
