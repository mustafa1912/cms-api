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
        Schema::create('company_sittings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('nameEn')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('whatsApp')->nullable();
            $table->string('fax')->nullable();
            $table->string('website')->nullable();
            $table->string('youtube')->nullable();
            $table->string('facebook')->nullable();
            $table->string('commercialRegister')->nullable();
            $table->string('taxCard')->nullable();
            $table->string('tax')->nullable();
            $table->string('logo')->nullable();
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
        Schema::dropIfExists('company_sittings');
    }
};
