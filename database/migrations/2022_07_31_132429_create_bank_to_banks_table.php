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
        Schema::create('bank_to_banks', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('FromBank_id')->nullable();
            $table->string('toBank_id')->nullable();
            $table->string('balance')->nullable();
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
        Schema::dropIfExists('bank_to_banks');
    }
};
