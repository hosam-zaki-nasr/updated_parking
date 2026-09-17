<?php

use Customer\Http\Controllers\GarageController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum', 'is_verified', 'customer']
], function () {

    Route::get('garages', [GarageController::class, 'index']);

    Route::get('garages/search', [GarageController::class, 'search']);

    Route::get('parking-garages/search', [GarageController::class, 'searchParkingGarages']);

    Route::get('garage/{garage}', [GarageController::class, 'show']);
});
