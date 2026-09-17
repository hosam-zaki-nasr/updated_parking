<?php

use Customer\Http\Controllers\RequestDriverController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum', 'is_verified', 'customer']
], function () {

    Route::get('request-drivers', [RequestDriverController::class, 'index']);

    Route::get('request-drivers/search', [RequestDriverController::class, 'search']);

    Route::get('request-driver/{requestDriver}', [RequestDriverController::class, 'show']);


    Route::post('request-driver-start-parking', [RequestDriverController::class, 'requestStart'])->middleware(['preventIfContact', 'PreventIfEmptyWallet']);

    Route::post('request-driver-end-parking', [RequestDriverController::class, 'requestEnd'])->middleware(['preventIfContact', 'PreventIfEmptyWallet']);

    Route::patch('request-driver-cancel/{requestDriver}', [RequestDriverController::class, 'cancel']);
});
