<?php

use Dashboard\Http\Controllers\ValetManagerController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum', 'admin']
], function () {

    Route::get('valet-managers', [ValetManagerController::class, 'index']);

    Route::get('valet-managers/search', [ValetManagerController::class, 'search']);

    Route::get('valet-manager/{user}', [ValetManagerController::class, 'show']);

    Route::post('valet-manager', [ValetManagerController::class, 'store']);

    Route::patch('valet-manager/{user}', [ValetManagerController::class, 'update']);

    Route::delete('valet-manager/{user}', [ValetManagerController::class, 'destroy']);
});
