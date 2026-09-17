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
        Schema::create('garages', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('name')->nullable();

            $table->string('name_ar')->nullable();

            $table->integer('site_number')->nullable();

            $table->double('hour_cost')->nullable()->default(0);

            $table->string('open_at')->nullable();

            $table->string('close_at')->nullable();

            $table->double('vip_cost')->default(0);

            $table->double('valet_cost')->nullable()->default(0);

            $table->double('fine_cost')->nullable()->default(0);

            $table->integer('free_hours')->nullable()->default(0);

            $table->double('subscription_price')->nullable()->default(0);

            $table->integer('max_car_count')->nullable()->default(0);

            $table->string('longitude')->nullable();

            $table->string('latitude')->nullable();

            $table->foreignUuid('country_id')->nullable();

            $table->foreignUuid('governorate_id')->nullable();

            $table->foreignUuid('type_id')->nullable();

            $table->foreignUuid('garage_id')->nullable();

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
        Schema::dropIfExists('garages');
    }
};
