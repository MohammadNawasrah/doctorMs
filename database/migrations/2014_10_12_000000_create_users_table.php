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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Auto-incremental primary key
            $table->string('firstName'); // First name
            $table->string('lastName'); // Last name
            $table->string('userName')->unique(); // Unique username
            $table->string('email'); // Unique email
            $table->string('type');
            $table->boolean('isAdmin')->default(false);
            $table->boolean('status')->default(true);
            $table->string('password'); // Password
            $table->string('token')->nullable(); // Token (nullable for email verification, for example)
            $table->timestamps(); // Created at and Updated at timestamps
        });
        DB::table('users')->insert([
            'firstName' => 'Mohammad',
            'lastName' => 'Nawasrah',
            'userName' => 'nawasrah',
            'email' => 'nawasrah@gmail.com',
            'type' => '1',
            'isAdmin' => '1',
            'status' => '1',
            'password' => '0cc138f8cb3f267360cd471a15deed69',
            'token' => 'null',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
