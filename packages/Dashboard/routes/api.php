<?php

use Dashboard\Http\Controllers\TutorialVedioController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum', 'admin']
], function () {

    Route::get('tutorial-vedio', [TutorialVedioController::class, 'show']);

    Route::post('tutorial-vedio', [TutorialVedioController::class, 'store']);

    Route::delete('tutorial-vedio', [TutorialVedioController::class, 'destroy']);
});
