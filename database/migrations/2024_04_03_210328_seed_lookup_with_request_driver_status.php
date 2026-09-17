<?php

use App\Constants\HasLookupType\RequestDriverStatus;
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
                'type' => RequestDriverStatus::LOOKUP_TYPE,
                'code' => RequestDriverStatus::PENDING['code'],
                'key' => RequestDriverStatus::PENDING['key'],
                'prefix' => RequestDriverStatus::PENDING['prefix'],
                'name' => RequestDriverStatus::PENDING['name'],
                'name_ar' => RequestDriverStatus::PENDING['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => RequestDriverStatus::LOOKUP_TYPE,
                'code' => RequestDriverStatus::ACCEPTED['code'],
                'key' => RequestDriverStatus::ACCEPTED['key'],
                'prefix' => RequestDriverStatus::ACCEPTED['prefix'],
                'name' => RequestDriverStatus::ACCEPTED['name'],
                'name_ar' => RequestDriverStatus::ACCEPTED['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => RequestDriverStatus::LOOKUP_TYPE,
                'code' => RequestDriverStatus::CANCELED['code'],
                'key' => RequestDriverStatus::CANCELED['key'],
                'prefix' => RequestDriverStatus::CANCELED['prefix'],
                'name' => RequestDriverStatus::CANCELED['name'],
                'name_ar' => RequestDriverStatus::CANCELED['name_ar'],
            ],
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
