<?php

use Dashboard\Http\Controllers\AdvertisementController;
use Illuminate\Support\Facades\Route;


Route::group([
	'middleware' => ['auth:sanctum', 'is_verified','customer']
], function () {

	Route::get('advertisements', [AdvertisementController::class, 'index']);

	Route::get('advertisements/search', [AdvertisementController::class, 'search']);

	Route::get('advertisement/{advertisement}', [AdvertisementController::class, 'show']);
});
