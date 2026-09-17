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
        Schema::create('subscriptions', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('starts_at')->nullable();

            $table->string('ends_at')->nullable();

            $table->double('amount')->nullable()->default(0);

            $table->boolean('auto_renew')->default(true);

            $table->foreignUuid('garage_id')->nullable();

            $table->foreignUuid('user_id')->nullable();

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
        Schema::dropIfExists('subscriptions');
    }
};
