<?php

namespace App\Foundations\LookupType;


use App\Constants\HasLookupType\UserAccountType;
use App\Models\SystemLookup;

class AccountTypeCollection

{
    public static function typeList()
    {
        return SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->get();
    }

    public static function admin()
    {
        return SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code',  UserAccountType::ADMIN['code'])
            ->first();
    }

    public static function customer()
    {
        return SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code',  UserAccountType::CUSTOMER['code'])
            ->first();
    }

    public static function driver()
    {
        return SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code',  UserAccountType::DRIVER['code'])
            ->first();
    }

    public static function contact()
    {
        return SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code',  UserAccountType::CONTACT['code'])
            ->first();
    }

    public static function garageOwner()
    {
        return SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code',  UserAccountType::GARAGE_OWNER['code'])
            ->first();
    }

    public static function valetManager()
    {
        return SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code',  UserAccountType::VALET_MANAGER['code'])
            ->first();
    }
}
