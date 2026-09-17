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
        Schema::create('user_notification_tokens', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('notification_token')->nullable();

            $table->string('current_user_token')->nullable();

            $table->foreignUuid('type_id')->nullable();

            $table->foreignUuid('user_id')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_notification_tokens');
    }
};
