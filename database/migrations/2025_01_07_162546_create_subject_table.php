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
        Schema::create('subjects', function (Blueprint $table) {
            $table->uuid('uuid_subject')->primary()->unique();
            $table->string('name');
            $table->string('day');
            $table->time('time');
            $table->integer('duration');
            $table->timestamps();

            $table->bigInteger('teacher')->nullable();
            $table->foreign('teacher')->references('nip')->on('teacher_employees');

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
        Schema::dropIfExists('subject');
    }
};
