<?php

use Garage\Http\Controllers\ParkingController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['auth:sanctum', 'garage_owner']
], function () {

    Route::post('DigitalCheckEntry', [ParkingController::class, 'requestStartParking'])->middleware('request_start_parking');

    Route::post('DigitalNotifyEntry', [ParkingController::class, 'startParking'])->middleware('request_start_parking');

    Route::post('DigitalCheckExit', [ParkingController::class, 'requestEndParking']);

    Route::post('DigitalNotifyExit', [ParkingController::class, 'endParking']);
});
