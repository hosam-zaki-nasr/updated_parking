<?php

use Driver\Http\Controllers\RequestDriverController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum', 'is_verified', 'driver']
], function () {

    Route::get('request-drivers', [RequestDriverController::class, 'index']);

    Route::get('request-drivers/search', [RequestDriverController::class, 'search']);

    Route::get('request-driver/{requestDriver}', [RequestDriverController::class, 'show']);

    Route::patch('request-driver-accept/{requestDriver}', [RequestDriverController::class, 'accept']);

    Route::patch('request-driver-disaccept/{requestDriver}', [RequestDriverController::class, 'disaccept']);
});
