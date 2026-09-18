<?php

use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Foundations\LookupType\GarageTypeCollection;
use App\Models\Garage;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $garage_parking_type_id = GarageTypeCollection::garage()->id;

        $garage_valet_type_id = GarageTypeCollection::valet()->id;

        $admin = User::where('account_type_id', AccountTypeCollection::admin()->id)->first();


        $driver_account_id = AccountTypeCollection::driver()->id;


        $garage_parking_1 = Garage::create([
            "name" => "egypt garage parking-1",
            "name_ar" => "egypt garage parking-1",
            "open_at" => "12:00",
            "close_at" => "23:00",
            "type_id" => $garage_parking_type_id,
            "site_number" => 100000,
            "max_car_count" => 100,
            "free_hours" => 1,
            "hour_cost" => 3,
            "vip_cost" => 5,
            "valet_cost" => 10,
            "fine_cost" => 3,
            "subscription_price" => SystemDefault::DEFAULT_SUBSCRIPTION_VALUE,
            "longitude" => 31.16281912829203,
            "latitude" => 30.987733963812225,
            "creator_id" => $admin->id
        ]);

        $garage_parking_2 = Garage::create([
            "name" => "egypt garage parking-2",
            "name_ar" => "egypt garage parking-2",
            "open_at" => "12:00",
            "close_at" => "23:00",
            "type_id" => $garage_parking_type_id,
            "site_number" => 100001,
            "max_car_count" => 100,
            "free_hours" => 1,
            "hour_cost" => 3,
            "vip_cost" => 5,
            "valet_cost" => 10,
            "fine_cost" => 3,
            "subscription_price" => SystemDefault::DEFAULT_SUBSCRIPTION_VALUE,
            "longitude" => 31.160418330603026,
            "latitude" => 30.98375878540727,
            "creator_id" => $admin->id
        ]);

        $garage_parking_3 = Garage::create([
            "name" => "egypt garage parking-3",
            "name_ar" => "egypt garage parking-3",
            "open_at" => "12:00",
            "close_at" => "23:00",
            "type_id" => $garage_parking_type_id,
            "site_number" => 100002,
            "max_car_count" => 100,
            "free_hours" => 1,
            "hour_cost" => 3,
            "vip_cost" => 5,
            "valet_cost" => 10,
            "fine_cost" => 3,
            "subscription_price" => SystemDefault::DEFAULT_SUBSCRIPTION_VALUE,
            "longitude" => 31.179991221359888,
            "latitude" => 30.98421035253746,
            "creator_id" => $admin->id
        ]);

        $garage_valet_1 = Garage::create([
            "name" => "egypt garage valet-1",
            "name_ar" => "egypt garage valet-1",
            "open_at" => "12:00",
            "close_at" => "23:00",
            "type_id" => $garage_valet_type_id,
            "site_number" => 100003,
            "max_car_count" => 100,
            "free_hours" => 1,
            "hour_cost" => 3,
            "vip_cost" => 5,
            "valet_cost" => 10,
            "fine_cost" => 3,
            "subscription_price" => SystemDefault::DEFAULT_SUBSCRIPTION_VALUE,
            "longitude" => 31.187551332896653,
            "latitude" => 30.972733385423325,
            "creator_id" => $admin->id,
            "garage_id" => $garage_parking_1->id
        ]);

        $garage_valet_2 = Garage::create([
            "name" => "egypt garage valet-2",
            "name_ar" => "egypt garage valet-2",
            "open_at" => "12:00",
            "close_at" => "23:00",
            "type_id" => $garage_valet_type_id,
            "site_number" => 100004,
            "max_car_count" => 100,
            "free_hours" => 1,
            "hour_cost" => 3,
            "vip_cost" => 5,
            "valet_cost" => 10,
            "fine_cost" => 3,
            "subscription_price" => SystemDefault::DEFAULT_SUBSCRIPTION_VALUE,
            "longitude" => 31.16180982578137,
            "latitude" => 30.960062895321784,
            "creator_id" => $admin->id,
            "garage_id" => $garage_parking_2->id
        ]);

        $garage_valet_3 = Garage::create([
            "name" => "egypt garage valet-3",
            "name_ar" => "egypt garage valet-3",
            "open_at" => "12:00",
            "close_at" => "23:00",
            "type_id" => $garage_valet_type_id,
            "site_number" => 100005,
            "max_car_count" => 100,
            "free_hours" => 1,
            "hour_cost" => 3,
            "vip_cost" => 5,
            "valet_cost" => 10,
            "fine_cost" => 3,
            "subscription_price" => SystemDefault::DEFAULT_SUBSCRIPTION_VALUE,
            "longitude" => 31.15013258405839,
            "latitude" => 30.964470511614262,
            "creator_id" => $admin->id,
            "garage_id" => $garage_parking_3->id
        ]);


        User::where('account_type_id', $driver_account_id)
            ->update(['garage_id' => $garage_valet_1->id]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
