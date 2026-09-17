<?php

use App\Constants\HasLookupType\UserAccountType;
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
                'type' => UserAccountType::LOOKUP_TYPE,
                'code' => UserAccountType::ADMIN['code'],
                'key' => UserAccountType::ADMIN['key'],
                'prefix' => UserAccountType::ADMIN['prefix'],
                'name' => UserAccountType::ADMIN['name'],
                'name_ar' => UserAccountType::ADMIN['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => UserAccountType::LOOKUP_TYPE,
                'code' => UserAccountType::CUSTOMER['code'],
                'key' => UserAccountType::CUSTOMER['key'],
                'prefix' => UserAccountType::CUSTOMER['prefix'],
                'name' => UserAccountType::CUSTOMER['name'],
                'name_ar' => UserAccountType::CUSTOMER['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => UserAccountType::LOOKUP_TYPE,
                'code' => UserAccountType::DRIVER['code'],
                'key' => UserAccountType::DRIVER['key'],
                'prefix' => UserAccountType::DRIVER['prefix'],
                'name' => UserAccountType::DRIVER['name'],
                'name_ar' => UserAccountType::DRIVER['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => UserAccountType::LOOKUP_TYPE,
                'code' => UserAccountType::CONTACT['code'],
                'key' => UserAccountType::CONTACT['key'],
                'prefix' => UserAccountType::CONTACT['prefix'],
                'name' => UserAccountType::CONTACT['name'],
                'name_ar' => UserAccountType::CONTACT['name_ar'],
            ],

        );

        DB::table('system_lookups')->insert($models);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('system_lookups')->where('type', UserAccountType::LOOKUP_TYPE)->delete();
    }
};
