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
        // patientId currentAppointment  nextappointment
        Schema::create('patientAppointments', function (Blueprint $table) {
            $table->id();
            $table->integer('patientId');
            $table->dateTime('currentAppointment');
            $table->dateTime('nextappointment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patientAppointments');
    }
};
