<?php

namespace App\Traits;

use App\Foundations\Notification\NotificationCollection;

trait NotificationTrait
{

    public function notify(array $module, array $event, array $data, bool $send_to_owner = false)
    {

        NotificationCollection::foramtContent($event, $data);

        $notification = NotificationCollection::createNotification($module, $event, $data,$send_to_owner);

        NotificationCollection::notify($event, $data, $notification,$send_to_owner);
    }
}
