<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbProductViewHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_product_view_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId("sub_category_id");
            $table->foreignId("user_id");
            $table->foreignId("taste_id");
            $table->string('product_name');
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
        Schema::dropIfExists('tb_product_view_history');
    }
}
