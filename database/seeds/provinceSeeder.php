<?php

use Illuminate\Database\Seeder;
use App\tb_province as Province;
class provinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = fopen(app_path().'/Etc/daerah/provinsi.csv','r');
        if($file!= false) {
            while(($data=fgetcsv($file,100))!=false){
                Province::insert([
                    "id"=>$data[0],
                    "province_name"=>$data[1]
                ]);
            }
        }
    }
}
