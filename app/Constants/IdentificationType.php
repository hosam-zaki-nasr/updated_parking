<?php

namespace App\Constants;

class IdentificationType
{

    public const STATUS_LIST = [
        0 => self::LICENSE_PALET,
        1 => self::QR_CODE,
    ];

    public const LICENSE_PALET = [
        'code' => 0,
        'key' => 0,
        'prefix' => "LICENSE_PALET",
        'name' => 'LicensePlate'
    ];
    public const QR_CODE = [
        'code' => 1,
        'key' => 1,
        'prefix' => "QR_CODE",
        'name' => 'QRCode'
    ];
}
