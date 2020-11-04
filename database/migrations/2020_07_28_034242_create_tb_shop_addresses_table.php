<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbShopAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_shop_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId("shop_id");
            $table->string("address_detail");
            $table->foreignId("province_id");
            $table->foreignId("city_id");
            $table->foreignId("subdistrict_id");
            $table->string('postal_code');
            $table->string("coordinates")->nullable();
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
        Schema::dropIfExists('tb_shop_addresses');
    }
}
