<?php

namespace Garage\Foundations;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginCollection
{
    public static function login($request)
    {

        $validated = $request->validated();

        $user = User::where('phone', $validated['Login'])->orWhere('email', $validated['Login'])->first();

        $is_auth = !empty($user) && Hash::check($validated['Password'], $user->password) ? true : false;

        if ($is_auth) {

            $user->api_token = $user->createToken('garage_owner')->plainTextToken;

            $user->save();

            return $user;
        }

        return false;

    }
}
