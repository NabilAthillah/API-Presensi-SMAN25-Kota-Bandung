<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_employees', function (Blueprint $table) {
            $table->bigInteger('nip')->unique()->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('address');
            $table->string('phone_number');
            $table->enum('role', ['administrator', 'teacher']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_employee');
    }
};
