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
        Schema::create('students', function (Blueprint $table) {
            $table->string('nisn')->unique()->primary();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('address');
            $table->string('phone_number');
            $table->timestamps();

            $table->string('parents')->nullable();
            $table->foreign('parents')->references('email')->on('parents');

            $table->string('class')->nullable();
            $table->foreign('class')->references('name')->on('class');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student');
    }
};
