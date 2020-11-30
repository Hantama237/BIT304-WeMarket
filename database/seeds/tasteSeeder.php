<?php

use Illuminate\Database\Seeder;
use App\tb_taste_kind as Taste;
class tasteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $taste = [
            "sweet",
            "plain",
            "acidic",
            "bitter",
            "savory",//gurih
            "sour",//masam
            "spicy",
            "minty",
            
        ];
        foreach ($taste as $t) {
            Taste::insert([
                "taste"=>$t,
            ]);
        }
    }
}
