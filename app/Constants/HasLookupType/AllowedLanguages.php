<?php

namespace App\Constants\HasLookupType;

class AllowedLanguages
{
     public const LOOKUP_TYPE = 3;

     public const LANGUAGES_LIST = [
          1 => self::ENGLISH,
          2 => self::ARABIC,
     ];

     public const ENGLISH = [
          'code' => 1,
          'key' => "en",
          'prefix' => 'ENGLISH',
          'name' => "English",
          'name_ar' => "الانجليزية",
     ];

     public const ARABIC = [
          'code' => 2,
          'key' => "ar",
          'prefix' => 'prefix',
          'name' => "Arabic",
          'name_ar' => "العربية",
     ];
}
