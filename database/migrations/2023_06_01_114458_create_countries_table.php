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
        Schema::create('countries', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('name')->nullable();

            $table->string('name_ar')->nullable();

            $table->string('phone_code')->nullable();

            $table->string('flag')->nullable();

            $table->string('prefix')->nullable();

            $table->string('longitude')->nullable();

            $table->string('latitude')->nullable();

            $table->integer('type'); //[country , governorate , city]

            $table->foreignUuid('country_id')->nullable();

            $table->foreignUuid('governorate_id')->nullable();

            $table->foreignUuid('city_id')->nullable();

            $table->foreignUuid('zone_id')->nullable();

            $table->foreignUuid('creator_id')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
