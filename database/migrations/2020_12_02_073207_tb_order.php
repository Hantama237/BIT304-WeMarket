<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbOrder extends Migration
{
    
    public function up()
    {
        Schema::create('tb_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->foreignId("shop_id");
            $table->string("status");
            $table->integer("total_price");
            $table->string("payment_method");
            $table->string("delivery_method");
            $table->string("address");
            $table->timestamp("order_date");
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
        Schema::dropIfExists('tb_orders');
    }


}
