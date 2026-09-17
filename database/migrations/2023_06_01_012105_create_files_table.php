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
        Schema::create('files', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('original_name')->nullable();

            $table->string('original_extension')->nullable();

            $table->string('module')->nullable();

            $table->string('type')->nullable();

            $table->string('new_name')->nullable();

            $table->string('file_path')->nullable();

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
        Schema::dropIfExists('files');
    }
};
