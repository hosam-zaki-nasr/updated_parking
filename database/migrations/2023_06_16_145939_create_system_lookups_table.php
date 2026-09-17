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
        Schema::create('system_lookups', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('name')->nullable();

            $table->string('name_ar')->nullable();

            $table->string('prefix')->nullable();

            $table->string('type');

            $table->string('key');
            
            $table->integer('code');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_lookups');
    }
};
