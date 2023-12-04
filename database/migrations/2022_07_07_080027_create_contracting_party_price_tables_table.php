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
        Schema::create('contracting_party_price_tables', function (Blueprint $table) {
            $table->id();

            $table->string('servicePrice')->nullable();
            $table->string('patientPrice')->nullable();
            $table->string('patientPer')->nullable();
            $table->string('sidePrice')->nullable();
            $table->string('sidePer')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->unsignedBigInteger('contractingPartyPrice_id')->nullable();
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
        Schema::dropIfExists('contracting_party_price_tables');
    }
};
