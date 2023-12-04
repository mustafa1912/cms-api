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
        Schema::create('lab_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lab_id')->nullable();
            $table->unsignedBigInteger('compositionType_id')->nullable();
            $table->unsignedBigInteger('composition_id')->nullable();
            $table->string('price')->nullable();
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
        Schema::dropIfExists('lab_prices');
    }
};
