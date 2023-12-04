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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('internationalCode')->nullable();
            $table->string('egyptCode')->nullable();
            $table->string('storeCode')->nullable();
            $table->unsignedBigInteger('measuring_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('kind_id')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->string('buyPrice')->nullable();
            $table->string('salePrice')->nullable();
            $table->string('MaximumDiscountRate')->nullable();
            $table->string('maxSaleQuantity')->nullable();
            $table->string('MinimumQuantity')->nullable();
            $table->string('QuantityLimit')->nullable();
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
        Schema::dropIfExists('items');
    }
};
