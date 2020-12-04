<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId("shop_id");
            $table->string("name");
            $table->string("description");
            $table->integer("price");
            $table->integer("stock");
            $table->string("picture")->nullable(); 
            $table->integer("status")->default(1);
            //newly added
            $table->foreignId("taste_id");
            $table->foreignId("sub_category_id");
            $table->integer("sold")->default(0);
            $table->integer("taste_level");
            $table->string("search_tag")->nullable()->default("");
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
        Schema::dropIfExists('tb_products');
    }
}
