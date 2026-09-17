<?php

namespace App\Foundations\Notification;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsCollection
{

    private  $url = '';
    private  $token = '';

    public function __construct()
    {
        $this->url = config('app.sms_url');
        $this->token = config('app.sms_token');
    }

    public function sendVerifyPhone(User $user, $code)
    {
        if ($user->phone) {

            self::sendSms($user, $code);
        }
    }

    public function sendResetPasswordCode(User $user, $code)
    {
        if ($user->phone) {

            self::sendSms($user, $code);
        }
    }

    public function sendSms(User $user, $message = "")
    {
        $body = [
            "src" => "fwj",
            "dests" => [$user->phone],
            "body" => json_encode([$message]),
            "priority" => 0,
            "delay" => 0,
            "validity" => 0,
            "maxParts" => 0,
            "dlr" => 0,
            "prevDups" => 0,
            "msgClass" => "promotional"
        ];

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token

        ])->post($this->url, $body)->object();

        Log::info(json_encode($response));

        return $response;
    }
}
