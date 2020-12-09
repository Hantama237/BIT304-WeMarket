<?php

use Illuminate\Database\Seeder;
use App\tb_category as Category;
class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories =[
            "vegetables",
            "fruit",
            "vegetables & fruit",
            "seasoning & spices",
            "rice"
        ];

        foreach ($categories as $c) {
            Category::insert(["category"=>$c]);
        }
    }
}
