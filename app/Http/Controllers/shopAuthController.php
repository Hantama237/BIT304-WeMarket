<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_shop as Shop;
use Session;
class shopAuthController extends Controller
{
    //
    public function indexRegister(){
        $shop = Shop::isExist(Session::get("id"));
        if($shop){
            $shop1=Shop::get()->where("id",Session::get("id"));
           // dd($shop);
            return view('seller.dashboard',['shop1'=>$shop1]);
            //return "Welcome to seller dashboard";
        }
        //return view("seller.dasboard");
    }

    public function register(Request $req){
        $req->merge(["user_id"=>Session::get("id")]);
        $validatedData = $req->validate(Shop::getValidationRules());
        $shop = Shop::register($validatedData);
        if($shop){
            
            return "Shop registration success";
        }
        return redirect()->back();
    }
    public function update(){
        $shop=Shop::get()->where("id",Session::get("id"));
        return view('seller.update',['shop'=>$shop]);
    }
    public function process(Request $request){
        $shop=Shop::where("id",Session::get("id"))->first();
        // dd($shop->idcard_picture);
        // dd($request->name);
        //$validatedData = $request->validate(Shop::getValidationRules());
        $this->validate($request, [
        "name"=>"required|unique:tb_shops|min:3|regex:/^\S*$/u",
        "user_id"=>"required|exists:tb_users,id",
        "description"=>"required|min:3",
        "idcard_picture"=>"nullable|file|image|mimes:jpeg,png,jpg|max:2048",
        "status"=>"nullable",]);
        // store file data as variable $file
        $idcard_picture = $request->file('idcard_picture');
        $idcard_picture_name = time()."_".$idcard_picture->getClientOriginalName();
        // Move file to data_file folder
		$upload_to = 'data_file';
        $idcard_picture->move($upload_to,$idcard_picture_name);

    //    $shop->insert($request); 
        $shop->name = $request->name;
        $shop->description=$request->description;
        $shop->idcard_picture=$idcard_picture_name;
       $shop->save();
       //Session::flash('message','Update successfully.');
        return redirect()->back();
    }

}
