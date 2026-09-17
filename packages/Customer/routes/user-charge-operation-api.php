<?php

use Customer\Http\Controllers\UserChargeOperationController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum', 'is_verified', 'customer']
], function () {

    Route::get('current-balance', [UserChargeOperationController::class, 'index']);
    Route::post('charge-balance', [UserChargeOperationController::class, 'store'])->middleware('preventIfContact');
});

Route::any('success-page', [UserChargeOperationController::class, 'successPage']);
