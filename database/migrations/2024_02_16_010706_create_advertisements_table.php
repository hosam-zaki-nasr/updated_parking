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
        Schema::create('advertisements', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('title')->nullable();

            $table->text('details')->nullable();

            $table->integer('amount')->default(0);

            $table->text('link')->nullable();

            $table->string('client_name')->nullable();

            $table->string('client_phone')->nullable();

            $table->string('client_field')->nullable();

            $table->string('starts_at')->nullable();

            $table->string('ends_at')->nullable();

            $table->foreignUuid('file_id')->nullable();

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
        Schema::dropIfExists('advertisements');
    }
};
