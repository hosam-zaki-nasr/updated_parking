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
        Schema::create('request_drivers', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('details')->nullable();

            $table->string('longitude')->nullable();

            $table->string('latitude')->nullable();

            $table->integer('repeated_times')->default(1)->nullable();

            $table->foreignUuid('garage_id')->nullable();

            $table->foreignUuid('user_id')->nullable();

            $table->foreignUuid('driver_id')->nullable();

            $table->foreignUuid('creator_id')->nullable();

            $table->foreignUuid('canceler_id')->nullable();

            $table->foreignUuid('status_id')->nullable();

            $table->foreignUuid('type_id')->nullable();

            $table->foreignUuid('parking_id')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_drivers');
    }
};
