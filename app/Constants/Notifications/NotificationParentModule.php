<?php

namespace App\Constants\Notifications;

class NotificationParentModule
{

    public const TYPES = [
        1 => NotificationParentModule::REQUEST_DRIVER,
        2 => NotificationParentModule::PARKING,
    ];

    public const REQUEST_DRIVER = [
        'code' => 1,
        'prefix' => 'REQUEST_DRIVER',
        'name' => "Request Driver",
        'name_ar' => "طلب سائق",
    ];

    public const PARKING = [
        'code' => 2,
        'prefix' => 'PARKING',
        'name' => "Parking",
        'name_ar' => "الركنات",
    ];
}
