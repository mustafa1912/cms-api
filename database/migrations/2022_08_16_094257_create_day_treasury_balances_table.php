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
        Schema::create('day_treasury_balances', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('balance')->nullable();
            $table->unsignedBigInteger('treasury_id')->nullable();
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
        Schema::dropIfExists('day_treasury_balances');
    }
};
