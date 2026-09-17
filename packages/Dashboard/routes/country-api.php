<?php

use Dashboard\Http\Controllers\Country\CityController;
use Dashboard\Http\Controllers\Country\CountryController;
use Dashboard\Http\Controllers\Country\DistrictController;
use Dashboard\Http\Controllers\Country\GovernorateController;
use Dashboard\Http\Controllers\Country\ZoneController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum','admin']
], function () {

     Route::get('countries', [CountryController::class, 'index']);

     Route::get('countries/search', [CountryController::class, 'search']);

     Route::post('country', [CountryController::class, 'store']);

     Route::get('country/{country}', [CountryController::class, 'show']);

     Route::patch('country/{country}', [CountryController::class, 'update']);

     Route::delete('country/{country}', [CountryController::class, 'destroy']);


     Route::get('governorates/{country}', [GovernorateController::class, 'index']);

     Route::get('governorates/search/{country}', [GovernorateController::class, 'search']);

     Route::get('governorates-search-all', [GovernorateController::class, 'searchAll']);

     Route::post('governorate', [GovernorateController::class, 'store']);

     Route::get('governorate/{governorate}', [GovernorateController::class, 'show']);

     Route::patch('governorate/{governorate}', [GovernorateController::class, 'update']);

     Route::delete('governorate/{governorate}', [GovernorateController::class, 'destroy']);


     Route::get('cities/{governorate}', [CityController::class, 'index']);

     Route::get('cities/search/{governorate}', [CityController::class, 'search']);

     Route::get('cities-search-all', [CityController::class, 'searchAll']);

     Route::post('city', [CityController::class, 'store']);

     Route::get('city/{city}', [CityController::class, 'show']);

     Route::patch('city/{city}', [CityController::class, 'update']);

     Route::delete('city/{city}', [CityController::class, 'destroy']);


     Route::get('zones/{city}', [ZoneController::class, 'index']);

     Route::get('zones/search/{city}', [ZoneController::class, 'search']);

     Route::get('zones-search-all', [ZoneController::class, 'searchAll']);

     Route::post('zone', [ZoneController::class, 'store']);

     Route::get('zone/{zone}', [ZoneController::class, 'show']);

     Route::patch('zone/{zone}', [ZoneController::class, 'update']);

     Route::delete('zone/{zone}', [ZoneController::class, 'destroy']);


     Route::get('districts/{zone}', [DistrictController::class, 'index']);

     Route::get('districts/search/{zone}', [DistrictController::class, 'search']);

     Route::get('districts-search-all', [DistrictController::class, 'searchAll']);

     Route::post('district', [DistrictController::class, 'store']);

     Route::get('district/{district}', [DistrictController::class, 'show']);

     Route::patch('district/{district}', [DistrictController::class, 'update']);

     Route::delete('district/{district}', [DistrictController::class, 'destroy']);
});
