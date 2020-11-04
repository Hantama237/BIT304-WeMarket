<?php

use Illuminate\Database\Seeder;
use App\tb_subdistrict as SubDistrict;
class subdistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = fopen(app_path().'/Etc/daerah/kecamatan.csv','r');
        if($file!= false) {
            while(($data=fgetcsv($file,100))!=false){
                SubDistrict::insert([
                    "id"=>$data[0],
                    "subdistrict_name"=>$data[2],
                    "city_id"=>$data[1]
                ]);
            }
        }
    }
}
