<?php

use Customer\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum', 'is_verified', 'customer']
], function () {

    Route::get('cars', [CarController::class, 'index']);

    Route::get('cars/search', [CarController::class, 'search']);

    Route::get('car/{car}', [CarController::class, 'show']);

    Route::post('car', [CarController::class, 'store'])->middleware(['preventIfCarsEqualsThree']);

    Route::patch('car/{car}', [CarController::class, 'update']);

    Route::delete('car/{car}', [CarController::class, 'destroy']);
});
