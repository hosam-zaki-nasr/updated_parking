<?php

namespace App\Constants\HasLookupType;

class UserAccountType
{
    public const LOOKUP_TYPE = 1;

    public const TYPE_LIST = [
        1 => self::ADMIN,
        2 => self::CUSTOMER,
        3 => self::DRIVER,
        4 => self::CONTACT,
        5 => self::GARAGE_OWNER,
        6 => self::VALET_MANAGER,
    ];

    public const ADMIN = [
        'code' => 1,
        'key' => 1,
        'prefix' => "ADMIN",
        'name' => "Admin",
        'name_ar' => "أدمن",
    ];

    public const CUSTOMER = [
        'code' => 2,
        'key' => 2,
        'prefix' => "CUSTOMER",
        'name' => "Customer",
        'name_ar' => "مستخدم",
    ];

    public const DRIVER = [
        'code' => 3,
        'key' => 3,
        'prefix' => "DRIVER",
        'name' => "Driver",
        'name_ar' => "سائق",
    ];

    public const CONTACT = [
        'code' => 4,
        'key' => 4,
        'prefix' => "CONTACT",
        'name' => "Contact",
        'name_ar' => "جهة اتصال",
    ];

    public const GARAGE_OWNER = [
        'code' => 5,
        'key' => 5,
        'prefix' => "GARAGE_OWNER",
        'name' => "Garage Owner",
        'name_ar' => "مالك الجراج",
    ];

    public const VALET_MANAGER = [
        'code' => 6,
        'key' => 6,
        'prefix' => "VALET_MANAGER",
        'name' => "Valet Manager",
        'name_ar' => "مدير الفريق",
    ];
}
