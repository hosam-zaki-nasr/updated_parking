<?php

namespace App\Foundations\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordCollection
{
    public static function resetPassword($validated)
    {

        $user = User::where("reset_password_code", $validated['reset_password_code'])->first();

        $user->password = $validated['password'];

        $user->reset_password_code = null;

        $user->save();

        return $user;
    }
}
