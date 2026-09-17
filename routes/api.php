<?php

use App\CronJob\ForceEndParkedCar;
use App\CronJob\RenewSubscription;
use App\Http\Controllers\Country\CityController;
use App\Http\Controllers\Country\CountryController;
use App\Http\Controllers\Country\GovernorateController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\MobileVerificationController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserNotificationController;
use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SystemLookupController;
use Carbon\Carbon;
use Dashboard\Http\Controllers\TutorialVedioController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => ['auth:sanctum', 'is_verified']
], function () {

    Route::group([
        'prefix' => 'auth'
    ], function () {

        Route::post('register', [AuthController::class, 'register'])->withoutMiddleware(['auth:sanctum', 'is_verified']);

        Route::post('login', [AuthController::class, 'login'])->withoutMiddleware(['auth:sanctum', 'is_verified']);

        Route::any('logout', [AuthController::class, 'logout'])->withoutMiddleware('is_verified');

        Route::patch('send-verify-email-code', [EmailVerificationController::class, 'sendVerificationEmail'])->withoutMiddleware('is_verified');

        Route::patch('verify-email', [EmailVerificationController::class, 'verifyEmail'])->withoutMiddleware('is_verified');

        Route::patch('send-verify-mobile-code', [MobileVerificationController::class, 'sendVerificationMobile'])->withoutMiddleware('is_verified');

        Route::patch('verify-mobile', [MobileVerificationController::class, 'verifyMobile'])->withoutMiddleware(['auth:sanctum', 'is_verified']);


        Route::post('send-reset-password-code', [ResetPasswordController::class, 'sendResetPassword'])->withoutMiddleware(['auth:sanctum', 'is_verified']);

        Route::post('check-code', [ResetPasswordController::class, 'checkCode'])->withoutMiddleware(['auth:sanctum', 'is_verified']);

        Route::post('reset-password', [ResetPasswordController::class, 'resetPassword'])->withoutMiddleware(['auth:sanctum', 'is_verified']);


        Route::get('profile', [ProfileController::class, 'show']);

        Route::patch('profile', [ProfileController::class, 'update']);

        Route::delete('profile', [ProfileController::class, 'destroy']);
    });

    Route::group([
        'prefix' => 'storage'
    ], function () {

        Route::get('files', [FileController::class, 'index']);

        Route::post('file', [FileController::class, 'store']);

        Route::get('file/{file}', [FileController::class, 'show']);

        Route::delete('file/{file}', [FileController::class, 'destroy']);
    });

    Route::group([
        'prefix' => 'notification'
    ], function () {

        Route::get('notifications', [UserNotificationController::class, 'index']);

        Route::get('notifications/search', [UserNotificationController::class, 'search']);

        Route::get('notification/{notification}', [UserNotificationController::class, 'show']);

        Route::post('notification', [UserNotificationController::class, 'store']);

        Route::patch('mute-notifications', [UserNotificationController::class, 'muteNotifications']);

        Route::patch('unmute-notifications', [UserNotificationController::class, 'unmuteNotifications']);
    });
});

Route::group([
    'prefix' => 'country'
], function () {

    Route::get('countries', [CountryController::class, 'index']);

    Route::get('countries/search', [CountryController::class, 'search']);

    Route::get('country/{country}', [CountryController::class, 'show']);

    Route::get('governorates/{country}', [GovernorateController::class, 'index']);

    Route::get('governorates/search/{country}', [GovernorateController::class, 'search']);

    Route::get('governorate/{governorate}', [GovernorateController::class, 'show']);

    Route::get('cities/{country}', [CityController::class, 'index']);

    Route::get('cities/search/{country}', [CityController::class, 'search']);

    Route::get('city/{city}', [CityController::class, 'show']);
});

Route::group([
    'prefix' => 'constants'
], function () {

    Route::get('tutorial-vedio', [TutorialVedioController::class, 'show']);

    Route::get('car-colors-list', [ConstantsController::class, 'carColors']);

    Route::get('car-types-list', [ConstantsController::class, 'carTypes']);

    Route::get('charge-price-list', [ConstantsController::class, 'priceList']);
});

Route::get('system-lookup-types', [SystemLookupController::class, 'lookupTypes']);

Route::get('system-lookups/{type}', [SystemLookupController::class, 'index']);

Route::get('test-crone-job', function () {

    return Carbon::now()->format('y-m-d H:i:s');
    return ForceEndParkedCar::endParkedCars();
    return RenewSubscription::renewSubscriptions();
});
