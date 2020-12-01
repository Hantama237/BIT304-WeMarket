<?php

use Illuminate\Database\Seeder;
use App\tb_sub_category as SubCategory;
class subCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $subCategories=[
            //sayur id 0
            ["sub_category"=>"Potato","category_id"=>"0"],
            ["sub_category"=>"Cabbage","category_id"=>"0"],
            //buah id 1
            ["sub_category"=>"Orange","category_id"=>"1"],
            ["sub_category"=>"Apple","category_id"=>"1"],
            ["sub_category"=>"Avocado","category_id"=>"1"],
            //buah dan sayur id 2
            ["sub_category"=>"Pickle","category_id"=>"2"],
            ["sub_category"=>"Tomato","category_id"=>"2"],
        ];

        foreach ($subCategories as $sc) {
            SubCategory::insert($sc);
        }
    }
}