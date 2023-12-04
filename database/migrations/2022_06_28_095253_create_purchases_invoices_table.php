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
        Schema::create('purchases_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->unsignedBigInteger('store_id')->nullable();
            $table->string('payingKind')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('supplierBalance')->nullable();
            $table->unsignedBigInteger('payingKind_id')->nullable();
            $table->string('delegateName')->nullable();
            $table->string('notes')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('unit')->nullable();
            $table->string('amount')->nullable();
            $table->string('unitPrice')->nullable();
            $table->string('extraRatio')->nullable();
            $table->string('discountPercentage')->nullable();
            $table->string('totalPrice')->nullable();
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
        Schema::dropIfExists('purchases_invoices');
    }
};
