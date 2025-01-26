<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PasswordResetController;

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/verify-otp', [AuthController::class, 'verifyOTP']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/password/email', [PasswordResetController::class, 'sendResetLinkEmail']);
Route::post('/password/reset', [PasswordResetController::class, 'resetPassword']);
Route::post('/resend-verification-link', [AuthController::class, 'resendVerificationLink']);
// Protected Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/token/refresh', [AuthController::class, 'refreshToken']);
    Route::get('/me', [AuthController::class, 'me']);
});

