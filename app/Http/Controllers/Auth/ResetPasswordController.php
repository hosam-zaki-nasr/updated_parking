<?php

namespace App\Http\Controllers\Auth;

use App\Constants\StatusCode;
use App\Foundations\Auth\ResetPasswordCollection;
use App\Foundations\Notification\SmsCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CheckCodeRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\SendResetPasswordRequest;
use App\Http\Resources\Auth\UserMinifiedResource;
use App\Models\User;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{

    public function sendResetPassword(SendResetPasswordRequest $request)
    {
        $user = User::where('phone', $request->phone)->first();

        $random_code = rand(1000, 9999);

        $user->reset_password_code = $random_code;
        $user->mobile_verification_code = $random_code;

        $user->save();

        // $user->sendResetPasswordCodeNotification();
        $smsCollection = new SmsCollection();

        $smsCollection->sendResetPasswordCode($user, $user->reset_password_code);

        return response()->success(
            trans('general.done'),
            new UserMinifiedResource($user),
            StatusCode::OK
        );
    }

    public function checkCode(CheckCodeRequest $request)
    {
        $user = User::where('reset_password_code', $request->reset_password_code)->first();

        return response()->success(
            trans('general.retrived'),
            $user->reset_password_code,
            StatusCode::OK
        );
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $user = ResetPasswordCollection::resetPassword($request->validated());

        return response()->success(
            trans('general.done'),
            new UserMinifiedResource($user),
            StatusCode::OK
        );
    }
}
