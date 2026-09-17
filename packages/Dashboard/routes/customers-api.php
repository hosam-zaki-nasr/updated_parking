<?php

use Dashboard\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum','admin']
], function () {

    Route::get('customers', [CustomerController::class, 'index']);

    Route::get('customers/search', [CustomerController::class, 'search']);

    Route::get('customer/{user}', [CustomerController::class, 'show']);

    Route::post('customer', [CustomerController::class, 'store']);

    Route::patch('customer/{user}', [CustomerController::class, 'update']);

    Route::delete('customer/{user}', [CustomerController::class, 'destroy']);
});
