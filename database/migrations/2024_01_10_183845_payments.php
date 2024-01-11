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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("fk_record")->constrained("patient_records")->onDelete('cascade');
            $table->foreignId("fk_patient")->constrained("patients")->onDelete('cascade');
            $table->double('paymet_value', 9, 3)->nullable();
            $table->double('must_be_paid', 9, 3)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
