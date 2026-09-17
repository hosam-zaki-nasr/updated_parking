<?php

namespace App\Foundations\Auth;

use App\Foundations\LookupType\AccountTypeCollection;
use App\Foundations\Notification\SmsCollection;
use App\Models\User;
use App\Models\UserNotificationToken;

class RegisterCollection
{
    public static function register($validated)
    {
        $user =  User::create($validated);

        $user->account_type_id = AccountTypeCollection::customer()->id;

        $user->api_token = $user->createToken(Request()->userAgent())->plainTextToken;

        $user->mobile_verification_code = rand(1000, 9999);

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

        $smsCollection = new SmsCollection();

        $smsCollection->sendVerifyPhone($user, $user->mobile_verification_code);

        return $user;
    }
}
