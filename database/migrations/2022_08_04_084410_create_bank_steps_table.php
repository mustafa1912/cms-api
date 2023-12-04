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
        Schema::create('bank_steps', function (Blueprint $table) {
            $table->id();
            $table->string('kind')->nullable();
            $table->unsignedBigInteger('kind_id')->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->string('collection')->nullable();
            $table->string('pay')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('account_id')->nullable();
            $table->unsignedBigInteger('lab_id')->nullable();
            $table->unsignedBigInteger('contractingParty_id')->nullable();

            $table->string('note')->nullable();
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
        Schema::dropIfExists('bank_steps');
    }
};
