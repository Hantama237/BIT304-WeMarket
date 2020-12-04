<?php

use Illuminate\Database\Seeder;
use App\tb_user as User;
use App\tb_shop as shop;
use App\tb_shop_address as ShopAddress;
use App\tb_product as Product;

class baseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::register([
            "name"=>"Handryan Pratama",
            "email"=>"handp231@gmail.com",
            "password"=>"bali2000",
            "profile_picture"=>""
        ]);
        $shop = Shop::register([
            "name"=>"Hanshop",
            "user_id"=>$user->id,
            "description"=>"Fresh and Affordable",
            "idcard_picture"=>"",
            "status"=>1
        ]);
       //dd($shop);
        $address = ShopAddress::addAddress([
            "shop_id"=>$shop->id,
            "address_detail"=>"Kedungu belalang",
            "province_id"=>"51",
            "city_id"=>"5102",
            "subdistrict_id"=>"5102040",
            "postal_code"=>"31212",
            "coordinates"=>null,
        ]);
        
        
    }
}
