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
        Schema::create('patientToDoctor', function (Blueprint $table) {
            $table->id();
            $table->foreignId("userId")->constrained("users")->onDelete('cascade');
            $table->foreignId("patientId")->constrained("patients")->onDelete('cascade');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patientToDoctor');
    }
};