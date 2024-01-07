
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
        Schema::create('userPermission', function (Blueprint $table) {
            $table->id();
            $table->integer("userId");
            $table->text('jsonPermission');
            $table->timestamps();
        });
        DB::table('userPermission')->insert([
            "userId" => 1,
            'jsonPermission' => '{"users":{"showUsers":1,"addUser":1,"addUserPermission":1,"usersPage":1,"usersPage":1},"permission":{"permissionPage":1,"addPermission":1,"addAction":1}}',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userPermission');
    }
};
