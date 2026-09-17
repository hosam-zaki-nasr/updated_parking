<?php

use Customer\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum', 'is_verified', 'customer']
], function () {

    Route::get('subscriptions', [SubscriptionController::class, 'index']);

    Route::patch('subscription-renew-status/{subscription}', [SubscriptionController::class, 'update'])->middleware(['preventIfContact']);

    Route::post('subscription', [SubscriptionController::class, 'store'])->middleware(['preventIfContact', 'PreventIfEmptyWallet', 'PreventIfAlreadySubscribed']);
});
