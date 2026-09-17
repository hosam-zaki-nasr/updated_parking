<?php

namespace App\Constants\HasLookupType;

class CountryType
{
     public const LOOKUP_TYPE = 2;

     public const TYPE_LIST = [
          1 => self::COUNTRY,
          2 => self::GOVERNORATE,
          3 => self::CITY,
          4 => self::ZONE,
          5 => self::DISTRICT,
     ];

     public const COUNTRY = [
          'code' => 1,
          'key' => 1,
          'prefix' => 'COUNTRY',
          'name' => "Country",
          'name_ar' => "دولة",
     ];

     public const GOVERNORATE = [
          'code' => 2,
          'key' => 2,
          'prefix' => 'GOVERNORATE',
          'name' => "Governorate",
          'name_ar' => "محافظة",
     ];

     public const CITY = [
          'code' => 3,
          'key' => 3,
          'prefix' => 'CITY',
          'name' => "City",
          'name_ar' => "مدينة",
     ];
     
     public const ZONE = [
          'code' => 4,
          'key' => 4,
          'prefix' => 'ZONE',
          'name' => "Zone",
          'name_ar' => "منطقة",
     ];
     
     public const DISTRICT = [
          'code' => 5,
          'key' => 5,
          'prefix' => 'DISTRICT',
          'name' => "District",
          'name_ar' => "مقاطعة",
     ];
}
