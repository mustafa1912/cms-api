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
        Schema::create('precentage_doctor_tables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('percentageDoctor_id')->nullable();
            $table->string('percentage')->nullable();
            $table->string('price')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();
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
        Schema::dropIfExists('precentage_doctor_tables');
    }
};
