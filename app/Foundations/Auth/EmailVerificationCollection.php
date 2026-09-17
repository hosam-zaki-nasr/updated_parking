<?php

namespace App\Foundations\Auth;

use App\Models\User;

class EmailVerificationCollection
{
    public static function emailVerification($validated)
    {

        $user = User::where("email_verification_code", $validated['email_verification_code'])->first();

        if (!$user->hasVerifiedEmail()) {

            $user->markEmailAsVerified();
        }

        $user->email_verification_code = null;

        $user->save();
        
        return $user;
    }
}
