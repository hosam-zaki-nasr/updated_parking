<?php

use App\Constants\HasLookupType\AllowedLanguages;
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
                'type' => AllowedLanguages::LOOKUP_TYPE,
                'code' => AllowedLanguages::ENGLISH['code'],
                'key' => AllowedLanguages::ENGLISH['key'],
                'prefix' => AllowedLanguages::ENGLISH['prefix'],
                'name' => AllowedLanguages::ENGLISH['name'],
                'name_ar' => AllowedLanguages::ENGLISH['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => AllowedLanguages::LOOKUP_TYPE,
                'code' => AllowedLanguages::ARABIC['code'],
                'key' => AllowedLanguages::ARABIC['key'],
                'prefix' => AllowedLanguages::ARABIC['prefix'],
                'name' => AllowedLanguages::ARABIC['name'],
                'name_ar' => AllowedLanguages::ARABIC['name_ar'],
            ],

        );

        DB::table('system_lookups')->insert($models);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('system_lookups')->where('type', AllowedLanguages::LOOKUP_TYPE)->delete();
    }
};
