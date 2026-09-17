<?php

use Driver\Http\Controllers\ParkingController;
use Driver\Http\Controllers\ParkingFileController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum', 'is_verified', 'driver']
], function () {

    Route::get('parked-cars', [ParkingController::class, 'index']);

    Route::get('parked-cars/search', [ParkingController::class, 'search']);

    Route::get('parked-car/{parking}', [ParkingController::class, 'show']);

    Route::post('start-parking-car', [ParkingController::class, 'startParking']);

    Route::patch('confirm-start-parking-car/{parking}', [ParkingController::class, 'startParkingConfirm']);

    Route::patch('end-parking-car/{parking}', [ParkingController::class, 'endParking']);

    //files
    Route::get('parking-files/{parking}', [ParkingFileController::class, 'index']);

    Route::get('parking-files/search/{parking}', [ParkingFileController::class, 'search']);

    Route::get('parking-file/{parkingFile}', [ParkingFileController::class, 'show']);

    Route::post('parking-files', [ParkingFileController::class, 'store']);

    Route::delete('parking-file/{parkingFile}', [ParkingFileController::class, 'destroy']);
});
