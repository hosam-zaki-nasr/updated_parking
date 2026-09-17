<?php

namespace App\Constants\Notifications\ModulesEvents;

use App\Constants\Notifications\NotificationModel;
use App\Constants\Notifications\NotificationModelAction;
use App\Constants\Notifications\NotificationParentModule;

class NotificationParkingEvent
{

    public const TYPES = [

        1 => NotificationParkingEvent::REQUEST_START_PARKING,
        2 => NotificationParkingEvent::ACCEPT_REQUEST_DRIVER,
        3 => NotificationParkingEvent::CANCELED_REQUEST_DRIVER,
        4 => NotificationParkingEvent::REQUEST_END_PARKING,

        5 => NotificationParkingEvent::START_PARKINK,
        6 => NotificationParkingEvent::CONFIRM_START_PARKINK,
        7 => NotificationParkingEvent::END_PARKINK,

    ];


    public const REQUEST_START_PARKING = [
        'code' => 1,
        'prefix' => 'REQUEST_START_PARKING',
        'name' => "Request Start Parking",
        'name_ar' => "طلب بدء ركنة",
        'content' => 'Request Driver Has Been Sent By {CUSTOMER_NAME}',
        'content_ar' => 'تم ارسال طلب سائق بواسطة {CUSTOMER_NAME}',
        'reference_code' => 'REQUESTDRIVER001',
        'parent' => NotificationParentModule::REQUEST_DRIVER,
        'table' => NotificationModel::REQUEST_DRIVER,
        'action' => NotificationModelAction::CREATE
    ];

    public const ACCEPT_REQUEST_DRIVER = [
        'code' => 2,
        'prefix' => 'ACCEPT_REQUEST_DRIVER',
        'name' => "Request Driver Accepted",
        'name_ar' => "تم قبول طلب سائق",
        'content' => 'Request Driver Has Been Accepted By {DRIVER_NAME}',
        'content_ar' => 'تم الموافقه علي طلب سائق بواسطة {DRIVER_NAME}',
        'reference_code' => 'REQUESTDRIVER002',
        'parent' => NotificationParentModule::REQUEST_DRIVER,
        'table' => NotificationModel::REQUEST_DRIVER,
        'action' => NotificationModelAction::UPDATE
    ];

    public const CANCELED_REQUEST_DRIVER = [
        'code' => 3,
        'prefix' => 'CANCELED_REQUEST_DRIVER',
        'name' => "Request Driver Canceled",
        'name_ar' => "تم الغاء طلب سائق",
        'content' => 'Request Driver Has Been Canceled By {CANCELER_NAME}',
        'content_ar' => 'تم الغاء طلب سائق بواسطة {CANCELER_NAME}',
        'reference_code' => 'REQUESTDRIVER003',
        'parent' => NotificationParentModule::REQUEST_DRIVER,
        'table' => NotificationModel::REQUEST_DRIVER,
        'action' => NotificationModelAction::UPDATE
    ];

    public const REQUEST_END_PARKING = [
        'code' => 4,
        'prefix' => 'REQUEST_END_PARKING',
        'name' => "Request End Parking",
        'name_ar' => "طلب انهاء ركنة",
        'content' => 'Request Driver Has Been Sent By {CUSTOMER_NAME}',
        'content_ar' => 'تم ارسال طلب سائق بواسطة {CUSTOMER_NAME}',
        'reference_code' => 'REQUESTDRIVER004',
        'parent' => NotificationParentModule::REQUEST_DRIVER,
        'table' => NotificationModel::REQUEST_DRIVER,
        'action' => NotificationModelAction::CREATE
    ];

    public const START_PARKINK = [
        'code' => 5,
        'prefix' => 'START_PARKINK',
        'name' => "Start Parking",
        'name_ar' => "بدأ الركن",
        'content' => 'Start Parking By {DRIVER_NAME}',
        'content_ar' => 'تم بدأ الركن بواسطة {DRIVER_NAME}',
        'reference_code' => 'PARKING001',
        'parent' => NotificationParentModule::PARKING,
        'table' => NotificationModel::PARKING,
        'action' => NotificationModelAction::CREATE
    ];

    public const CONFIRM_START_PARKINK = [
        'code' => 6,
        'prefix' => 'CONFIRM_START_PARKINK',
        'name' => "Confirm Start Parking",
        'name_ar' => "تأكيد بدأ الركن",
        'content' => 'Confirm Start Parking By {DRIVER_NAME}',
        'content_ar' => 'تم تأكيد بدأ الركن بواسطة {DRIVER_NAME}',
        'reference_code' => 'PARKING002',
        'parent' => NotificationParentModule::PARKING,
        'table' => NotificationModel::PARKING,
        'action' => NotificationModelAction::UPDATE
    ];

    public const END_PARKINK = [
        'code' => 7,
        'prefix' => 'END_PARKINK',
        'name' => "END Parking",
        'name_ar' => "انهاء الركن",
        'content' => 'END Parking By {DRIVER_NAME}',
        'content_ar' => 'تم انهاء الركن بواسطة {DRIVER_NAME}',
        'reference_code' => 'PARKING003',
        'parent' => NotificationParentModule::PARKING,
        'table' => NotificationModel::PARKING,
        'action' => NotificationModelAction::UPDATE
    ];
}
