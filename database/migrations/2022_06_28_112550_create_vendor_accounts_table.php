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
        Schema::create('vendor_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('receiptNumber')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->string('supplierBalance')->nullable();
            $table->string('payingKind')->nullable();
            $table->unsignedBigInteger('payingKind_id')->nullable();
            $table->string('pricePaid')->nullable();
            $table->string('rest')->nullable();
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
        Schema::dropIfExists('vendor_accounts');
    }
};
