<?php

use Dashboard\Http\Controllers\Constants\CarColorController;
use Dashboard\Http\Controllers\Constants\CarTypeController;
use Dashboard\Http\Controllers\Constants\ChargePriceController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum', 'admin'],
    'prefix' => 'constants',
], function () {

    Route::get('car-types', [CarTypeController::class, 'index']);

    Route::get('car-types/search', [CarTypeController::class, 'search']);

    Route::get('car-type/{carType}', [CarTypeController::class, 'show']);

    Route::post('car-type', [CarTypeController::class, 'store']);

    Route::patch('car-type/{carType}', [CarTypeController::class, 'update']);

    Route::delete('car-type/{carType}', [CarTypeController::class, 'destroy']);


    Route::get('car-colors', [CarColorController::class, 'index']);

    Route::get('car-colors/search', [CarColorController::class, 'search']);

    Route::get('car-color/{carColor}', [CarColorController::class, 'show']);

    Route::post('car-color', [CarColorController::class, 'store']);

    Route::patch('car-color/{carColor}', [CarColorController::class, 'update']);

    Route::delete('car-color/{carColor}', [CarColorController::class, 'destroy']);


    Route::get('charge-price-list', [ChargePriceController::class, 'index']);

    Route::post('charge-price', [ChargePriceController::class, 'store']);

    Route::patch('charge-price/{chargePrice}', [ChargePriceController::class, 'update']);

    Route::delete('charge-price/{chargePrice}', [ChargePriceController::class, 'destroy']);
});
