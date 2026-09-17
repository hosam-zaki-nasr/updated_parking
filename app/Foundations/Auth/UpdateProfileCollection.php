<?php

namespace App\Foundations\Auth;

use App\Models\User;

class UpdateProfileCollection
{
    public static function updateProfile($validated)
    {
        $user = User::find(auth()->user()->id);

        $user->update($validated);

        return $user;
    }
}
