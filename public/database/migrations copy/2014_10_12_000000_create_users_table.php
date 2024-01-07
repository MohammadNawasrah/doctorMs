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
            $table->boolean('isAdmin')->default(false);
            $table->boolean('status')->default(true);
            $table->string('password'); // Password
            $table->string('token')->nullable(); // Token (nullable for email verification, for example)
            $table->timestamps(); // Created at and Updated at timestamps
        });
        DB::table('users')->insert([
            'firstName' => 'Mohammad',
            'lastName' => 'Nawasrah',
            'userName' => '_nawasrah',
            'email' => 'admin@gmail.com',
            'isAdmin' => true,
            'status' => true,
            'password' => md5('7285@Mohammad'),
            'token' => null,
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
        Schema::create('user_permission', function (Blueprint $table) {
            $table->id();
            $table->integer("userId");
            $table->string('jsonPermission');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_permission');
    }
};



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
            $table->string('jsonPermission');
            $table->timestamps();
        });

        // Insert a default row
        DB::table('permission')->insert([
            'jsonPermission' => '{"login":{"changePassword":0}}',
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



<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // id fullName age phoneNumber 
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('fullName');
            $table->string('phoneNumber')->unique();
            $table->string('token');
            $table->integer('age');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};














<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // patientId patientNote  
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patient_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId("patientId")->constrained("patients")->onDelete('cascade');
            $table->string('patientNote')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_records');
    }
};














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
        Schema::create('patient_appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("patientId")->constrained("patients")->onDelete('cascade');
            $table->dateTime('nextappointment');
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
        Schema::create('patient_to_doctor', function (Blueprint $table) {
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
        Schema::dropIfExists('patient_to_doctor');
    }
};

