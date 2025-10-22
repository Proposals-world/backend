<?php

use App\Http\Middleware\CheckUserStatus;
use App\Http\Middleware\EnsureEmailIsVerified;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\Localization;
use App\Http\Middleware\EnsureProfileIsComplete;
use App\Http\Middleware\RedirectIfProfileComplete;
use App\Http\Middleware\EnsureGuardianContactIsVerified;
use App\Http\Middleware\EnsurePhoneIsVerified;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            Localization::class,
        ]);
        $middleware->alias([
            'admin' => isAdmin::class,
            'profile.complete' => EnsureProfileIsComplete::class,
            'redirect.if.profile.complete' => RedirectIfProfileComplete::class,
            'check.status' => CheckUserStatus::class,
            'guardian.verified' => EnsureGuardianContactIsVerified::class,
            'phone.verified' => EnsurePhoneIsVerified::class,
            'verified' => EnsureEmailIsVerified::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
