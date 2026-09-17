<?php

namespace App\Http\Controllers\Auth;

use App\Constants\StatusCode;
use App\Foundations\Auth\EmailVerificationCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\EmailVerificationRequest;
use App\Http\Resources\Auth\UserMinifiedResource;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{

    public function sendVerificationEmail(Request $request)
    {
        $user = $request->user();

        $user->email_verification_code = rand(100000, 999999);

        $user->save();

        $user->sendEmailVerificationNotification();

        return response()->success(
            trans('auth.email_verification_code_sent_successfully'),
            new UserMinifiedResource($user),
            StatusCode::OK
        );
    }

    public function verifyEmail(EmailVerificationRequest $request)
    {
        $user = EmailVerificationCollection::emailVerification($request->validated());

        return response()->success(
            trans('auth.email_verified_successfully'),
            new UserMinifiedResource($user),
            StatusCode::OK
        );
    }
}
