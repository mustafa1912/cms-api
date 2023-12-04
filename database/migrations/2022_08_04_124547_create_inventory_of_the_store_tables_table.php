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
        Schema::create('inventory_of_the_store_tables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('InventoryOfTheStore_id')->nullable();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('buyingPrice')->nullable();
            $table->string('sellingPrice')->nullable();
            $table->string('balance')->nullable();
            $table->string('total')->nullable();
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
        Schema::dropIfExists('inventory_of_the_store_tables');
    }
};
