<?php

use Dashboard\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum', 'admin']
], function () {

    Route::get('garage-report', [ReportController::class, 'garageReport']);

    Route::get('parking-report', [ReportController::class, 'parkingReport']);

    Route::get('customer-report', [ReportController::class, 'customerReport']);

    Route::get('contact-report', [ReportController::class, 'contactReport']);

    Route::get('car-report', [ReportController::class, 'carReport']);

    Route::get('driver-report', [ReportController::class, 'driverReport']);

    Route::get('subscription-report', [ReportController::class, 'subscriptionReport']);

    Route::get('dashboard-report-counter', [ReportController::class, 'dashboardCounter']);
});
