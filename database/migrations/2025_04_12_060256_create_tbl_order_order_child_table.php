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
        Schema::create('tbl_order_order_child', function (Blueprint $table) {
            $table->id();
            $table->string('oc_master_id');
            $table->string('oc_product_id');
            $table->string('oc_master_qut');
            $table->string('oc_total_price');
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
        Schema::dropIfExists('tbl_order_order_child');
    }
};
