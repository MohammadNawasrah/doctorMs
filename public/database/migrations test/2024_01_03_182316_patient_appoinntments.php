<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // patientId currentAppointment  next_appointment
        Schema::create('patientAppointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("patientId")->constrained("patients")->onDelete('cascade');
            $table->dateTime('next_appointment');
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
