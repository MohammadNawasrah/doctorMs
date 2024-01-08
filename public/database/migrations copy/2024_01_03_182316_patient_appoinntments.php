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
        Schema::create('patient_appointments', function (Blueprint $table) {

            $table->id();
            $table->boolean('status_to_send_doctor')->default(false);
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
        Schema::dropIfExists('patient_appointments');
    }
};
