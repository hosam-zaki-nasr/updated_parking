<?php

use App\Constants\HasLookupType\UserAccountType;
use App\Models\SystemLookup;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // SystemLookup::create([
        //     'id' => Str::uuid()->toString(),
        //     'type' => UserAccountType::LOOKUP_TYPE,
        //     'code' => UserAccountType::VALET_MANAGER['code'],
        //     'key' => UserAccountType::VALET_MANAGER['key'],
        //     'prefix' => UserAccountType::VALET_MANAGER['prefix'],
        //     'name' => UserAccountType::VALET_MANAGER['name'],
        //     'name_ar' => UserAccountType::VALET_MANAGER['name_ar'],
        // ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
