<?php

namespace App\Functions;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Session;
use File;

class uploadFunction{
    public static function uploadFotoUser(Request $request) {
        if(!$request->hasFile('profile_picture')) {
            return response()->json(['upload_file_not_found'], 400);
        }
        $file = $request->file('profile_picture');
        if(!$file->isValid()) {
            return response()->json(['invalid_file_upload'], 400);
        }
        $id = Session::get('id');
        $fotoUser = $request->file('profile_picture');
        $img = Image::make($fotoUser->getRealPath())->resize(150, 150);
        $path = public_path() . '/images/user/'.$id;
        $filename = Str::random(10).'.'.$fotoUser->getClientOriginalExtension();
        $img->save(public_path('/images/user/' .$id.'/'. $filename));
        // return (object)[
        //     "success" => true,
        //     "filename" => $filename,
        // ];
        return response()->json(compact("filename")); 
     }
     public static function uploadUserPhoto(Request $req){
        if(!$req->hasFile('profile_picture')){
            return (object)[
                "success"=>false,
                "message"=>"not found"
            ];
        }
        $userPhoto = $req->file('profile_picture');
        $img = Image::make($userPhoto)->fit(400,400);
        $path = public_path() . '/images/user/'.Session::get('id');
        if(!File::isDirectory($path))
        File::makeDirectory($path,0755,true);
        $filename = Str::random(10).".".$userPhoto->getClientOriginalExtension();
        //$fotoHotel->move($path,$filename);
        $img->save($path."/".$filename);
        return (object)[
            "success"=>true,
            "data"=>$filename,
            "path"=>$path
        ];
    }
}