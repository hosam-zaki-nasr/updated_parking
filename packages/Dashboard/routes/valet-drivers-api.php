<?php

use Dashboard\Http\Controllers\ValetDriverController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum', 'admin']
], function () {

    Route::get('valet-drivers', [ValetDriverController::class, 'index']);

    Route::get('valet-drivers/search', [ValetDriverController::class, 'search']);

    Route::get('valet-driver/{user}', [ValetDriverController::class, 'show']);

    Route::post('valet-driver', [ValetDriverController::class, 'store']);

    Route::patch('valet-driver/{user}', [ValetDriverController::class, 'update']);

    Route::delete('valet-driver/{user}', [ValetDriverController::class, 'destroy']);
});
