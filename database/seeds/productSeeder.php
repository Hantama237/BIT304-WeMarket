<?php

use Illuminate\Database\Seeder;
use App\tb_products as Product;
use App\tb_shop as Shop;
class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shop = Shop::where("name","Hanshop")->first();
        $product = Product::where("id",3)->first();
        //dd($product->shop->address->province);
        $product = Product::addProduct([
            "shop_id"=>$shop->id,
            "name"=>"Jeruk Bali",
            "description"=>"Harga per Kg, Jeruk ini dipanen langsung di perkebunan jeruk yang bertempat di bali dan disortir dengan standar yang baik",
            "price"=>20000,
            "stock"=>120,
            "picture"=>"",
            "status"=>1,
            "taste_id"=>1,
            "sub_category_id"=>3,
            "sold"=>0,
            "taste_level"=>3,
            "search_tag"=>"",
        ]);
        
        Product::generateSearchTag($product->id);
        
        $product = Product::addProduct([
            "shop_id"=>$shop->id,
            "name"=>"Jeruk Purut",
            "description"=>"Harga per Kg, Jeruk ini dipanen langsung di perkebunan jeruk yang bertempat di bali dan disortir dengan standar yang baik",
            "price"=>20000,
            "stock"=>120,
            "picture"=>"",
            "status"=>1,
            "taste_id"=>3,
            "sub_category_id"=>3,
            "sold"=>0,
            "taste_level"=>2,
            "search_tag"=>"",
        ]);
        Product::generateSearchTag($product->id);
        $product = Product::addProduct([
            "shop_id"=>$shop->id,
            "name"=>"Jeruk Nipis",
            "description"=>"Harga per Kg, Jeruk ini dipanen langsung di perkebunan jeruk yang bertempat di bali dan disortir dengan standar yang baik",
            "price"=>20000,
            "stock"=>120,
            "picture"=>"",
            "status"=>1,
            "taste_id"=>3,
            "sub_category_id"=>3,
            "sold"=>0,
            "taste_level"=>4,
            "search_tag"=>"",
        ]);
        Product::generateSearchTag($product->id);
    }
}
