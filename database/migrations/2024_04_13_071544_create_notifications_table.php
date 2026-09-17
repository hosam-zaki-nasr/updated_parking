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
        Schema::create('notifications', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('module_code')->nullable();

            $table->string('module_prefix')->nullable();

            $table->string('module_name')->nullable();

            $table->string('module_name_ar')->nullable();

            $table->foreignUuid('event_id')->nullable();

            $table->string('event_action')->nullable();

            $table->string('event_table_name')->nullable();

            $table->string('event_code')->nullable();

            $table->string('event_prefix')->nullable();

            $table->string('event_name')->nullable();

            $table->string('event_name_ar')->nullable();

            $table->string('event_content')->nullable();

            $table->string('event_content_ar')->nullable();

            $table->string('event_reference_code')->nullable();

            $table->json('data')->nullable();

            $table->foreignUuid('actor_id')->nullable();

            $table->string('occurred_at')->nullable();

            $table->string('watched_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
