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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('nameEn')->nullable();
            $table->string('nid')->nullable();
            $table->string('membershipNo')->nullable();
            $table->string('socialStatus')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsApp')->nullable();
            $table->string('mail')->nullable();
            $table->string('specialization')->nullable();
            $table->string('department')->nullable();
            $table->string('degree')->nullable();
            $table->string('referralDoctor')->nullable();
            $table->string('contributing')->nullable();
            $table->string('costCenter')->nullable();
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
        Schema::dropIfExists('doctors');
    }
};
