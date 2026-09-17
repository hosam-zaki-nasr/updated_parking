<?php

use Garage\Http\Controllers\ServerAuthController;
use Illuminate\Support\Facades\Route;


Route::post('DigitalAuthenticate', [ServerAuthController::class, 'login']);

Route::any('DigitalPing', [ServerAuthController::class, 'ping']);
