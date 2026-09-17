<?php

namespace App\Constants\Notifications;

class NotificationModel
{

    public const TYPES = [

        1 => NotificationModel::REQUEST_DRIVER,
        2 => NotificationModel::PARKING,
    ];

    public const REQUEST_DRIVER = [
        'code' => 1,
        'prefix' => 'REQUEST_DRIVER',
        'table_name' => "request_drivers",
    ];

    public const PARKING = [
        'code' => 2,
        'prefix' => 'PARKING',
        'table_name' => "parkings",
    ];
}
