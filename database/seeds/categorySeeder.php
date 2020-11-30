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
            "vegetables and fruit"
        ];

        foreach ($categories as $c) {
            Category::insert($c);
        }
    }
}
