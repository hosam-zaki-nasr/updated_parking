<?php

use App\Constants\HasLookupType\CountryType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $models = array(

            [
                'id' => Str::uuid()->toString(),
                'type' => CountryType::LOOKUP_TYPE,
                'code' => CountryType::COUNTRY['code'],
                'key' => CountryType::COUNTRY['key'],
                'prefix' => CountryType::COUNTRY['prefix'],
                'name' => CountryType::COUNTRY['name'],
                'name_ar' => CountryType::COUNTRY['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => CountryType::LOOKUP_TYPE,
                'code' => CountryType::GOVERNORATE['code'],
                'key' => CountryType::GOVERNORATE['key'],
                'prefix' => CountryType::GOVERNORATE['prefix'],
                'name' => CountryType::GOVERNORATE['name'],
                'name_ar' => CountryType::GOVERNORATE['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => CountryType::LOOKUP_TYPE,
                'code' => CountryType::CITY['code'],
                'key' => CountryType::CITY['key'],
                'prefix' => CountryType::CITY['prefix'],
                'name' => CountryType::CITY['name'],
                'name_ar' => CountryType::CITY['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => CountryType::LOOKUP_TYPE,
                'code' => CountryType::ZONE['code'],
                'key' => CountryType::ZONE['key'],
                'prefix' => CountryType::ZONE['prefix'],
                'name' => CountryType::ZONE['name'],
                'name_ar' => CountryType::ZONE['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => CountryType::LOOKUP_TYPE,
                'code' => CountryType::DISTRICT['code'],
                'key' => CountryType::DISTRICT['key'],
                'prefix' => CountryType::DISTRICT['prefix'],
                'name' => CountryType::DISTRICT['name'],
                'name_ar' => CountryType::DISTRICT['name_ar'],
            ],

        );

        DB::table('system_lookups')->insert($models);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('system_lookups')->where('type', CountryType::LOOKUP_TYPE)->delete();
    }
};
