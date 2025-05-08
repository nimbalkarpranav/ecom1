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
        Schema::create('tbl_order_master', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('order_m_customer_id');
            $table->string('order_m_total_price');
            $table->string('order_m_adderss');
            $table->string('order_m_date');
             $table->decimal('total', 10, 2);
            $table->string('payment_method')->default('COD');
            $table->string('payment_status')->default('Pending');
            $table->string('order_status')->default('Pending');
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
        Schema::dropIfExists('tbl_order_master');
    }
};
