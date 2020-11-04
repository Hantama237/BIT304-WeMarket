<?php

use Illuminate\Database\Seeder;
use App\tb_city as City;
class citySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = fopen(app_path().'/Etc/daerah/kabupaten.csv','r');
        if($file!= false) {
            while(($data=fgetcsv($file,100))!=false){
                City::insert([
                    "id"=>$data[0],
                    "city_name"=>$data[2],
                    "province_id"=>$data[1]
                ]);
            }
        }
    }
}
