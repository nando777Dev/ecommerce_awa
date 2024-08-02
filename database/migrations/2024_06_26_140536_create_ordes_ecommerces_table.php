<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ordes_ecommerces', function (Blueprint $table) {
            $table->id();
            $table->integer('business_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('transaction_id')->unsigned();
            $table->string('billing_type');
            $table->date('date_created');
            $table->date('due_date');
            $table->string('status');
            $table->string('installment_parcel', 255);
            $table->string('payment_link', 255);
            $table->string('pix_transaction');
            $table->string('pixQrCodeId');
            $table->double('value');
            $table->double('netValue');
            $table->foreign('business_id')->references('id')->on('business');
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordes_ecommerces');
    }
};
