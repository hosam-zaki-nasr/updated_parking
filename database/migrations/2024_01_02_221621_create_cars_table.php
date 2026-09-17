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
        Schema::create('cars', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('name')->nullable();

            $table->string('number')->nullable();

            $table->string('text')->nullable();

            $table->string('full_number')->nullable();

            $table->string('details')->nullable();

            $table->string('random_code')->nullable();

            $table->foreignUuid('file_id')->nullable();

            $table->foreignUuid('car_color_id')->nullable();

            $table->foreignUuid('car_type_id')->nullable();

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
        Schema::dropIfExists('cars');
    }
};
