<?php

use App\Constants\HasLookupType\RequestDriverTypes;
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
                'type' => RequestDriverTypes::LOOKUP_TYPE,
                'code' => RequestDriverTypes::START_PARKING['code'],
                'key' => RequestDriverTypes::START_PARKING['key'],
                'prefix' => RequestDriverTypes::START_PARKING['prefix'],
                'name' => RequestDriverTypes::START_PARKING['name'],
                'name_ar' => RequestDriverTypes::START_PARKING['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => RequestDriverTypes::LOOKUP_TYPE,
                'code' => RequestDriverTypes::END_PARKING['code'],
                'key' => RequestDriverTypes::END_PARKING['key'],
                'prefix' => RequestDriverTypes::END_PARKING['prefix'],
                'name' => RequestDriverTypes::END_PARKING['name'],
                'name_ar' => RequestDriverTypes::END_PARKING['name_ar'],
            ]
        );

        DB::table('system_lookups')->insert($models);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
