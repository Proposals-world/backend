<?php

use App\Http\Controllers\Api\UserProfileController;
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
});
