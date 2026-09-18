<?php

namespace App\Foundations\Notification;

use App\Constants\SystemDefault;
use App\Http\Resources\NotificationResource;
use Carbon\Carbon;
use App\Models\Notification;
use App\Models\NotificationRecipient;
use App\Models\User;
use App\Models\UserNotificationToken;
use Dashboard\Http\Resources\Customer\CustomerMinifiedResource;
use Dashboard\Http\Resources\ValetDriver\ValetDriverMinifiedResource;
use Google\Client;
use Illuminate\Support\Facades\Log;

class NotificationCollection
{

    final static public function foramtContent(array &$event, array $data)
    {

        foreach ($data['content_data'] as $key => $value) {

            $event['content'] = str_replace('{' . strtoupper($key) . '}', $value, $event['content']);

            $event['content_ar'] = str_replace('{' . strtoupper($key) . '}', $value, $event['content_ar']);
        }
    }

    final static public function createNotification(array $module, array $event, array $data, bool $send_to_owner = false)
    {
        $notification = Notification::Create([
            'module_code' => $module['code'],
            'module_prefix' => $module['prefix'],
            'module_name' => $module['name'],
            'module_name_ar' => $module['name_ar'],

            'event_table_name' => $event['table']['table_name'],
            'event_action' => $event['action']['prefix'],
            'event_code' => $event['code'],
            'event_prefix' => $event['prefix'],
            'event_name' => $event['name'],
            'event_name_ar' => $event['name_ar'],
            'event_content' => $event['content'],
            'event_content_ar' => $event['content_ar'],
            'event_reference_code' => $event['reference_code'],

            'data' => json_encode($data['content_data']),
            'event_id' => $data['event_id'],

            'actor_id' => $data['actor_id'],
            'occurred_at' => $data['occurred_at'],
        ]);

        foreach ($data['recipients'] as $recipient) {

            if ($send_to_owner == true) {

                if ($recipient->user_id != auth()->id()) {

                    NotificationRecipient::create([

                        'notification_id' => $notification->id,

                        'recipient_id' => $recipient->user_id,
                    ]);
                }
            } else {

                NotificationRecipient::create([

                    'notification_id' => $notification->id,

                    'recipient_id' => $recipient->user_id,
                ]);
            }
        }

        return $notification;
    }

    final static public function getUserNotifications(
        $user_id,
        $per_page = SystemDefault::DEFAULT_PAGINATION_COUNT
    ) {

        return Notification::whereHas('recipients', function ($q) use ($user_id) {
            $q->where('recipient_id', $user_id);
        })
            ->with('recipient', function ($q) use ($user_id) {
                $q
                    ->where('recipient_id', $user_id);
            })
            ->orderBy('created_at', 'desc')->paginate($per_page);
    }

    final static public function markReadNotifications($notifications)
    {
        foreach ($notifications as $notification) {
            $notification_recipient = NotificationRecipient::getById($notification->recipient->id);

            $notification_recipient->update(
                [
                    'watched_at' => Carbon::now()
                ]
            );
        }
    }

    public static function notify(array $event, array $data, Notification $notification, bool $send_to_owner = false)
    {
        $registrationIds =  [];

        foreach ($data['recipients'] as $token_obj) {

            if ($send_to_owner == true) {
                if ($token_obj->user_id != auth()->id()) {

                    array_push($registrationIds, $token_obj->notification_token);
                }
            } else {
                array_push($registrationIds, $token_obj->notification_token);
            }
        }

        $customData = $notification;

        self::send_notifications_FCM($registrationIds, $event['name'], $event['content'], $notification->id, "create", $customData);
    }

    public static function send_notifications_FCM($notification_ids, $title, $message, $id, $type, $customData = [])
    {
        // $notification_ids = UserNotificationToken::pluck('notification_token');

        $customData = self::prepareCustomData($customData);

        $client = new Client();
        $client->setAuthConfig(config('app.google_application_credentials'));
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithAssertion();
        }

        $accessToken = $client->getAccessToken()['access_token'];
        $projectId = 'vpm-systems';
        $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

        $headers = [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json',
        ];

        foreach ($notification_ids as $key => $token) {
            $post_data = [
                'message' => [
                    'token' => $token,
                    'notification' => [
                        'title' => $title,
                        'body' => $message,
                    ],
                    'data' => array_merge([
                        'id' => $id,
                        'type' => $type,
                    ], ["notification_model" => json_encode($customData)]),
                ],
            ];

            // Log::info($post_data['message']['data']);
            // dd($post_data['message']['data']);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $result = curl_exec($ch);

            // if ($key == count($notification_ids) - 1) {
            //     dd($result);
            // }

            curl_close($ch);


            // Handle the result as needed
        }
    }

    public static function prepareCustomData($customData)
    {

        $content_data = json_decode($customData['data']);

        $data['id'] = $customData['id'];
        $data['event_id'] = $customData['event_id'];
        $data['module_code'] = $customData['module_code'];
        $data['module_prefix'] = $customData['module_prefix'];
        $data['module_name'] = $customData['module_name'];
        $data['module_name_ar'] = $customData['module_name_ar'];
        $data['event_action'] = $customData['event_action'];
        $data['event_table_name'] = $customData['event_table_name'];
        $data['event_code'] = $customData['event_code'];
        $data['event_prefix'] = $customData['event_prefix'];
        $data['event_name'] = $customData['event_name'];
        $data['event_name_ar'] = $customData['event_name_ar'];
        $data['event_content'] = $customData['event_content'];
        $data['event_content_ar'] = $customData['event_content_ar'];
        $data['event_reference_code'] = $customData['event_reference_code'];
        $data['watched'] = $customData['watched'];
        $data['occurred_at'] = $customData['occurred_at'];
        $data['watched_at'] = $customData['watched_at'];
        $data['created_at'] = $customData['created_at'];
        $data['customer'] = isset($content_data->CUSTOMER_ID) && $content_data->CUSTOMER_ID != null ? new CustomerMinifiedResource(User::find($content_data->CUSTOMER_ID)) : null;
        $data['driver'] = isset($content_data->DRIVER_ID) && $content_data->DRIVER_ID != null ? new ValetDriverMinifiedResource(User::find($content_data->DRIVER_ID)) : null;


        return $data;
    }
}
