<?php

namespace App\Http\Controllers\Auth;

use App\Constants\StatusCode;
use App\Foundations\Auth\MobileVerificationCollection;
use App\Foundations\Notification\SmsCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\MobileVerificationRequest;
use App\Http\Resources\Auth\UserMinifiedResource;
use App\Http\Resources\Auth\UserResource;
use Illuminate\Http\Request;

class MobileVerificationController extends Controller
{

    public function sendVerificationMobile(Request $request)
    {
        $user = $request->user();

        $user->mobile_verification_code = rand(1000, 9999);

        $user->save();

        $smsCollection = new SmsCollection();

        $smsCollection->sendVerifyPhone($user, $user->mobile_verification_code);

        return response()->success(
            trans('general.done'),
            new UserMinifiedResource($user),
            StatusCode::OK
        );
    }

    public function verifyMobile(MobileVerificationRequest $request)
    {
        $user = MobileVerificationCollection::mobileVerification($request->validated());

        return response()->success(
            trans('general.done'),
            new UserResource($user),
            StatusCode::OK
        );
    }
}
