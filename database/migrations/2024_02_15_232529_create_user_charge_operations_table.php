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
        Schema::create('user_charge_operations', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->double('amount')->nullable()->default(0);

            $table->text('notes')->nullable();

            $table->string('payment_for')->nullable();

            $table->string('reference')->nullable();

            $table->foreignUuid('user_id')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_charge_operations');
    }
};
