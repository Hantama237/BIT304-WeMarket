<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbOrderProducts extends Migration
{
    public function up()
    {
        Schema::create('tb_order_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId("order_id");
            $table->foreignId("product_id");
            $table->integer("quantity");
            $table->integer("price");
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
        Schema::dropIfExists('tb_order_products');
    }
}
