<?php

namespace App\Foundations\Auth;

use App\Models\User;
use Carbon\Carbon;

class MobileVerificationCollection
{
    public static function mobileVerification($validated)
    {

        $user = User::where("mobile_verification_code", $validated['mobile_verification_code'])->first();

        if (!$user->mobile_verification_code) {

            $user->mobile_verified_at = Carbon::now();
        }

        $user->mobile_verification_code = null;
        $user->reset_password_code = null;

        $user->save();

        return $user;
    }
}
