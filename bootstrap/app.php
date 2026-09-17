<?php

use Garage\Http\Middleware\RequestStartParkingMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth_api' => \App\Http\Middleware\Api::class,
            'customer' => \Customer\Http\Middleware\CheckAccountTypeCustomerMiddleware::class,
            'preventIfContact' => \Customer\Http\Middleware\PreventIfContactMiddleware::class,
            'PreventIfEmptyWallet' => \Customer\Http\Middleware\PreventIfEmptyWalletMiddleware::class,
            'PreventIfAlreadySubscribed' => \Customer\Http\Middleware\PreventIfAlreadySubscribedMiddleware::class,
            'preventIfContactsEqualsThree' => \Customer\Http\Middleware\PreventIfContactsEqualsThreeMiddleware::class,
            'preventIfCarsEqualsThree' => \Customer\Http\Middleware\PreventIfCarsEqualsThreeMiddleware::class,
            'admin' => \Dashboard\Http\Middleware\CheckAccountTypeAdminMiddleware::class,
            'driver' => \Driver\Http\Middleware\CheckAccountTypeDriverMiddleware::class,
            'garage_owner' => \Garage\Http\Middleware\CheckAccountTypeGarageOwnerMiddleware::class,
            'request_start_parking' => RequestStartParkingMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn(Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();


$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

return $app;
