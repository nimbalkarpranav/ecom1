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
        Schema::create('tbl__cart', function (Blueprint $table) {
            $table->id('cart_id');
            $table->string('cart_customer_id');
            $table->string('cart_product_id');
            $table->string('cart_product_qut');
            $table->string('cart_total_price');
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
        Schema::dropIfExists('tbl__cart');
    }
};
