<?php

use Dashboard\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum','admin']
], function () {

	Route::get('admins', [AdminController::class, 'index']);

	Route::get('admins/search', [AdminController::class, 'search']);

	Route::get('admin/{user}', [AdminController::class, 'show']);

	Route::post('admin', [AdminController::class, 'store']);

	Route::patch('admin/{user}', [AdminController::class, 'update']);

	Route::delete('admin/{user}', [AdminController::class, 'destroy']);
});
