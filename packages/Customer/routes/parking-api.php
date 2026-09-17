<?php

use Customer\Http\Controllers\ParkingController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum', 'is_verified','customer']
], function () {

    Route::get('parked-cars', [ParkingController::class, 'index']);

    Route::get('parked-cars/search', [ParkingController::class, 'search']);

    Route::get('parked-car/{parking}', [ParkingController::class, 'show']);

});
