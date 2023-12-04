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
        Schema::create('invoice_returneds', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('numberOfInvoice')->nullable();
            $table->string('dateOfInvoice')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('store_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('unit')->nullable();
            $table->string('amount')->nullable();
            $table->string('unitPrice')->nullable();
            $table->string('total')->nullable();
            $table->string('discountPercentage')->nullable();
            $table->string('discount')->nullable();
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
        Schema::dropIfExists('invoice_returneds');
    }
};
