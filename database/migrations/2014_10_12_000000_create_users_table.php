<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('qr_id')->nullable()->unique();

            $table->string('name')->nullable();

            $table->string('email')->nullable()->unique();

            $table->string('phone')->unique();

            $table->string('gender')->nullable();

            $table->string('birthday')->nullable();

            $table->string('image_url')->nullable();

            $table->string('api_token')->nullable();

            $table->string('password');

            $table->boolean('notification_status')->default(true);

            $table->double('current_balance')->default(0);

            $table->string('email_verification_code')->unique()->nullable();

            $table->string('mobile_verification_code')->unique()->nullable();

            $table->string('reset_password_code')->unique()->nullable();

            $table->foreignUuid('account_type_id')->nullable();

            $table->foreignUuid('garage_id')->nullable();

            $table->foreignUuid('country_id')->nullable();

            $table->foreignUuid('governorate_id')->nullable();

            $table->foreignUuid('customer_id')->nullable();

            $table->foreignUuid('file_id')->nullable();

            $table->foreignUuid('creator_id')->nullable();


            $table->timestamp('email_verified_at')->nullable();

            $table->timestamp('mobile_verified_at')->nullable();

            $table->rememberToken();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
