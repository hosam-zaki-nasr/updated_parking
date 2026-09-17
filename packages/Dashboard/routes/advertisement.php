<?php

use Dashboard\Http\Controllers\AdvertisementController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum','admin']
], function () {

	Route::get('advertisements', [AdvertisementController::class, 'index']);

	Route::get('advertisements/search', [AdvertisementController::class, 'search']);

	Route::get('advertisement/{advertisement}', [AdvertisementController::class, 'show']);

	Route::post('advertisement', [AdvertisementController::class, 'store']);

	Route::patch('advertisement/{advertisement}', [AdvertisementController::class, 'update']);

	Route::delete('advertisement/{advertisement}', [AdvertisementController::class, 'destroy']);
});
