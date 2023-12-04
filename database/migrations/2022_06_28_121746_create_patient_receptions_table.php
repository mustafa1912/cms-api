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
        Schema::create('patient_receptions', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->unsignedBigInteger('clinic_id')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->unsignedBigInteger('contractingParty_id')->nullable();
            $table->string('payingKind')->nullable();
            $table->unsignedBigInteger('payingKind_id')->nullable();
            $table->string('allServicePatient')->nullable();
            $table->string('totalBearingSide')->nullable();
            $table->string('discountValue')->nullable();
            $table->string('discountPercentage')->nullable();
            $table->string('discount_per')->nullable();
            $table->string('total')->nullable();
            $table->string('note')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->longText('cancelNote')->nullable();
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
        Schema::dropIfExists('patient_receptions');
    }
};
