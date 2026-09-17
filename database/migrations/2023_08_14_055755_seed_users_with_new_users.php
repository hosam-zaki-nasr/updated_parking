<?php

use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        $admin_account_id = AccountTypeCollection::admin()->id;

        $customer_account_id = AccountTypeCollection::customer()->id;

        $contact_account_id = AccountTypeCollection::contact()->id;

        $driver_account_id = AccountTypeCollection::driver()->id;

        User::create([

            'account_type_id' => $admin_account_id,

            'name' => 'admin',

            'email' => 'admin@admin.admin',

            'password' => 123456,

            'phone' => 123456789,

            'address'  => 'admin address',

        ]);

        User::create([

            'account_type_id' => $customer_account_id,

            'name' => 'customer',

            'email' => 'customer@customer.customer',

            'password' => 123456,

            'phone' => 1234567891,

            'address'  => 'customer address',

        ]);

        User::create([

            'account_type_id' => $contact_account_id,

            'name' => 'contact',

            'email' => 'contact@contact.contact',

            'password' => 123456,

            'phone' => 1234567892,

            'address'  => 'contact address',

        ]);

        User::create([

            'account_type_id' => $driver_account_id,

            'name' => 'driver',

            'email' => 'driver@driver.driver',

            'password' => 123456,

            'phone' => 1234567893,

            'address'  => 'driver address',

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
