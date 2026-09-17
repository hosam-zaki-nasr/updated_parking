<?php

namespace App\Constants;

class GeneralBooleanStatus
{

     public const STATUS_LIST = [
          0 => self::OFF,
          1 => self::ON,
     ];

     public const OFF = [
          'code' => 0,
          'key' => 0,
          'prefix' => "OFF",
          'name' => 'FALSE'
     ];

     public const ON = [
          'code' => 1,
          'key' => 1,
          'prefix' => "ON",
          'name' => 'TRUE'
     ];
}
