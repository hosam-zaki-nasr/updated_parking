<?php

use Customer\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum', 'is_verified', 'customer']
], function () {

    Route::get('contacts', [ContactController::class, 'index']);

    Route::get('contacts/search', [ContactController::class, 'search']);

    Route::get('contact/{user}', [ContactController::class, 'show']);

    Route::post('contact', [ContactController::class, 'store'])->middleware(['preventIfContact', 'preventIfContactsEqualsThree']);

    Route::patch('contact/{user}', [ContactController::class, 'update'])->middleware('preventIfContact');

    Route::delete('contact/{user}', [ContactController::class, 'destroy'])->middleware('preventIfContact');
});
