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
<<<<<<< HEAD:public/database/migrations copy/2024_01_06_113003_html_code_for_page.php
        Schema::create('HtmlCod', function (Blueprint $table) {
=======
        Schema::create('user_permission', function (Blueprint $table) {
>>>>>>> patient:database/migrations/2024_01_01_200009_add_permission_table.php
            $table->id();
            $table->string("pageName");
            $table->text("patientId");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
<<<<<<< HEAD:public/database/migrations copy/2024_01_06_113003_html_code_for_page.php
        Schema::dropIfExists('HtmlCod');
=======
        Schema::dropIfExists('user_permission');
>>>>>>> patient:database/migrations/2024_01_01_200009_add_permission_table.php
    }
};
