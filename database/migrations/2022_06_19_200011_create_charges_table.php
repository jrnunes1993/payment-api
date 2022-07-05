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
            $table->string('paymentLink', 200);
            //$table->foreign('studentId')->references('id')->on('students');
            $table->enum('status', ['Paid', 'Pending', 'Canceled'])->default('Pending');
            $table->string('referenceId', 100)->nullable();
            $table->enum('type', ['creditCard', 'debitCard', 'bankSlip']);
            $table->dateTime('dueDate');
            $table->dateTime('paidedAt')->nullable()->default(NULL);
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
