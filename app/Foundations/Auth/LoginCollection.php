<?php

namespace App\Foundations\Auth;

use App\Models\User;
use App\Models\UserNotificationToken;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class LoginCollection
{
    public static function login($validated)
    {

        $user = User::where('phone', $validated['user'])->orWhere('email', $validated['user'])->first();

        $user->api_token = $user->createToken(Request()->userAgent())->plainTextToken;

        $user->save();

        if (isset($validated['notification_token']) && $validated['notification_token']) {

            $userNotificationToken = UserNotificationToken::where('notification_token', $validated['notification_token'])->first();

            if (!$userNotificationToken) {

                $user_notification['notification_token'] =  $validated['notification_token'];

                $user_notification['current_token'] =  $user->api_token;

                $user_notification['user_id'] =  $user->id;

                UserNotificationToken::create($user_notification);
            }
        }

        return $user;
    }
}
