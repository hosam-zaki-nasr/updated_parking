<?php

use Dashboard\Http\Controllers\ParkingController;
use Dashboard\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum', 'admin']
], function () {

    Route::patch('force-end-parking/{parking}', [ParkingController::class, 'update']);
});
