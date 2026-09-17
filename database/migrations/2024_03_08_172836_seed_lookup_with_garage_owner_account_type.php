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
        SystemLookup::create([
            'id' => Str::uuid()->toString(),
            'type' => UserAccountType::LOOKUP_TYPE,
            'code' => UserAccountType::GARAGE_OWNER['code'],
            'key' => UserAccountType::GARAGE_OWNER['key'],
            'prefix' => UserAccountType::GARAGE_OWNER['prefix'],
            'name' => UserAccountType::GARAGE_OWNER['name'],
            'name_ar' => UserAccountType::GARAGE_OWNER['name_ar'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
