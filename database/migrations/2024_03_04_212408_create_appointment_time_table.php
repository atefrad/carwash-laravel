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
        Schema::create('appointment_time', function (Blueprint $table) {
            $table->foreignId('time_id')->constrained('times');
            $table->foreignId('appointment_id')->constrained('appointments');

            $table->primary(['time_id', 'appointment_id'], 'appointment_time_primary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_time');
    }
};
