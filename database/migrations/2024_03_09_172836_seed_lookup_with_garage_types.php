<?php

use App\Constants\HasLookupType\GarageTypes;
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
                'type' => GarageTypes::LOOKUP_TYPE,
                'code' => GarageTypes::GARAGE_PARKING['code'],
                'key' => GarageTypes::GARAGE_PARKING['key'],
                'prefix' => GarageTypes::GARAGE_PARKING['prefix'],
                'name' => GarageTypes::GARAGE_PARKING['name'],
                'name_ar' => GarageTypes::GARAGE_PARKING['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => GarageTypes::LOOKUP_TYPE,
                'code' => GarageTypes::VALET_PARKING['code'],
                'key' => GarageTypes::VALET_PARKING['key'],
                'prefix' => GarageTypes::VALET_PARKING['prefix'],
                'name' => GarageTypes::VALET_PARKING['name'],
                'name_ar' => GarageTypes::VALET_PARKING['name_ar'],
            ],
            // [
            //     'id' => Str::uuid()->toString(),
            //     'type' => GarageTypes::LOOKUP_TYPE,
            //     'code' => GarageTypes::GARAGE_AND_VALET_PARKING['code'],
            //     'key' => GarageTypes::GARAGE_AND_VALET_PARKING['key'],
            //     'prefix' => GarageTypes::GARAGE_AND_VALET_PARKING['prefix'],
            //     'name' => GarageTypes::GARAGE_AND_VALET_PARKING['name'],
            //     'name_ar' => GarageTypes::GARAGE_AND_VALET_PARKING['name_ar'],
            // ],
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
