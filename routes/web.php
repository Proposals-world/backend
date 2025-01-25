<?php

use App\Http\Controllers\Admin\CountriesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LocationsController;
use App\Http\Controllers\MessageSubscriptionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('admin/countries', CountriesController::class);
// Route to handle message subscriptions
Route::post('/subscribe-message', [MessageSubscriptionController::class, 'subscribe'])->name('subscribe.message');

require __DIR__.'/auth.php';
