<?php

use App\Constants\HasLookupType\UserAccountType;
use App\Models\SystemLookup;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        $garage_owner_account_id = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('key', UserAccountType::GARAGE_OWNER['key'])
            ->first()->id;

        User::create([

            'account_type_id' => $garage_owner_account_id,

            'name' => 'garage_owner',

            'email' => 'garage_owner@garage_owner.garage_owner',

            'password' => 123456,

            'phone' => '01231239201',

            'address'  => 'garage_owner address',

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
