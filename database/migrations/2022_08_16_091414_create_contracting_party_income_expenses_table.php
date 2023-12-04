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
        Schema::create('contracting_party_income_expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date')->nullable();
            $table->unsignedBigInteger('payingKind')->nullable();
            $table->unsignedBigInteger('payingKind_id')->nullable();
            $table->unsignedBigInteger('contractingParty_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('collection')->nullable();
            $table->string('pay')->nullable();
            $table->string('note')->nullable();
            $table->string('softDelete')->default(0);
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
        Schema::dropIfExists('contracting_party_income_expenses');
    }
};
