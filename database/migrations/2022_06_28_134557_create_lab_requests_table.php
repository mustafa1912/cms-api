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
        Schema::create('lab_requests', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->unsignedBigInteger('lab_id')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->string('kind')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('bite')->nullable();
            $table->string('Code')->nullable();
            $table->string('compositionType')->nullable();
            $table->string('deliveryDate')->nullable();
            $table->string('delivery')->nullable();
            $table->integer('active')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('lab_requests');
    }
};
