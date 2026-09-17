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
        Schema::create('parkings', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('starts_at')->nullable();

            $table->string('ends_at')->nullable();

            $table->boolean('force_closed')->nullable()->default(false);

            $table->double('total_cost')->default(0);

            $table->integer('free_hours')->default(0);

            $table->double('hour_cost')->default(0);

            $table->foreignUuid('garage_id')->nullable();

            $table->foreignUuid('user_id')->nullable();

            $table->foreignUuid('car_id')->nullable();

            $table->string('longitude')->nullable();

            $table->string('latitude')->nullable();

            $table->string('start_confirmed_at')->nullable();

            $table->foreignUuid('start_driver_id')->nullable();

            $table->foreignUuid('end_driver_id')->nullable();

            ////////////////////////////////
            $table->string('QueryDate')->nullable();

            $table->string('VehicleClass')->nullable();

            $table->string('IdentificationType')->nullable();

            $table->string('IdentificationNumber')->nullable();

            $table->string('ClientId')->nullable();

            $table->integer('SiteNumber')->nullable();

            $table->integer('ParcNumber')->nullable();

            $table->integer('ZoneNumber')->nullable();

            $table->integer('EquipmentNumber')->nullable();

            $table->string('EntryDate')->nullable();

            $table->string('TicketId')->nullable();

            ////////////////////////////////

            $table->string('ExitDate')->nullable();

            $table->string('Amount')->nullable();

            $table->string('ClosingType')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parkings');
    }
};
