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
        Schema::create('patient_reception_tables', function (Blueprint $table) {
            $table->id();
            $table->string('servicePrice')->nullable();
            $table->string('patientPrice')->nullable();
            $table->string('patientPer')->nullable();
            $table->string('sidePrice')->nullable();
            $table->string('sidePer')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->unsignedBigInteger('patientReception_id')->nullable();
            $table->integer('discount_amount')->nullable();
            $table->string('discount_per')->nullable();
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
        Schema::dropIfExists('patient_reception_tables');
    }
};
