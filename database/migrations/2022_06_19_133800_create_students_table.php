<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 50);
            $table->enum('status', ['Registered', 'Locked', 'Canceled'])->default('Registered');
            $table->string('document',50);
            $table->string('phoneNumber', 50);
            $table->string('country', 50);
            $table->string('city', 50);
            $table->string('street', 50);
            $table->integer('number');
            $table->string('locality', 50);
            $table->string('state', 2);
            $table->string('postalCode', 30);
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
        Schema::dropIfExists('students');
    }
}
