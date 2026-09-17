<?php

use Dashboard\Http\Controllers\GarageController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum','admin']
], function () {

	Route::get('garages', [GarageController::class, 'index']);

	Route::get('garages/search', [GarageController::class, 'search']);

	Route::get('garage/{garage}', [GarageController::class, 'show']);

	Route::post('garage', [GarageController::class, 'store']);

	Route::patch('garage/{garage}', [GarageController::class, 'update']);

	Route::delete('garage/{garage}', [GarageController::class, 'destroy']);
});
