<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permission', function (Blueprint $table) {
            $table->id();
            $table->text('jsonPermission');
            $table->timestamps();
        });

        // Insert a default row
        DB::table('permission')->insert([
            'jsonPermission' => '{"users":{"showUsers":0,"addUser":0,"addUserPermission":0,"usersPage":0},"permission":{"permissionPage":0,"addPermission":0,"addAction":0,"showPermission":0},"HtmlCodPermission":{"HtmlCodPermisisonPage":0,"addHtmlCodPermiision":0}}',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission');
    }
};
