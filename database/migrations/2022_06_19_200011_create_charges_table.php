<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charges', function (Blueprint $table) {
            $table->id();
            $table->float('value');
            $table->integer('studentId');
            //$table->foreign('studentId')->references('id')->on('students');
            $table->enum('status', ['paid', 'pending', 'canceled'])->default('pending');
            $table->string('referenceId', 100);
            $table->enum('type', ['creditCard', 'debitCard', 'bankSlip']);
            $table->dateTime('dueDate');
            $table->dateTime('paidedAt')->default(NULL);
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
        Schema::dropIfExists('charges');
    }
}
