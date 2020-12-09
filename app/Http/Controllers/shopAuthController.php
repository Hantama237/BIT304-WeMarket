<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_shop as Shop;
use App\tb_shop_address as Address;
use Session;
use App\tb_province as Province;
use App\tb_city as City;
use App\tb_subdistrict as SubDistrict;
use App\tb_orders as Order;
use App\tb_products as Product;
class shopAuthController extends Controller
{
    //
    public function indexRegister(){
        $shop = Shop::isExist(Session::get("id"));
        if($shop){

            $shop1=Shop::get()->where("user_id",Session::get("id"));
            $shop2=Shop::where("user_id",Session::get("id"))->first();
            $order=Order::where("shop_id",$shop2->id)->where('status',"wait for seller")->count();
            $sold=Order::where("shop_id",$shop2->id)->where('status',"complete")->count();
            $product = Product::where('shop_id',$shop2->id)->count();
            // dd($shop1);
            if($shop2->status == 0){
                return view('seller.newSeller',['shop1'=>$shop1]);    
            }
            return view('seller.dashboard',['shop1'=>$shop1,'order'=>$order,'sold'=>$sold,'product'=>$product]);
            
        }
        return view("seller.register");
    }

    public function register(Request $req){
        $req->merge(["user_id"=>Session::get("id")]);
        $validatedData = $req->validate(Shop::getValidationRules());
        $shop = Shop::register($validatedData);
        if($shop){
            
            return redirect('/seller/dashboard');
        }
        return redirect()->back();
    }
    public function update(){
        $shop=Shop::isExist(Session::get("id"));
        $address=Address::where('shop_id',$shop->id)->first();
        return view('seller.update',['shop'=>[$shop],"address"=>$address]);
    }

    public function updateAddressIndex(Request $req){
        $shop = Shop::isExist(Session::get("id"));
        $address = Address::where('shop_id',$shop->id)->first();
 
        $provincies = Province::getHtmlOption();
        if($address != null){
            $city=City::getHtmlOption($address->province_id);
            $subdistrict=SubDistrict::getHtmlOption($address->city_id);
            return view('seller.address',["shop"=>[$shop],"address"=>$address,"province"=>$provincies->data,"city"=>$city->data,"subdistrict"=>$subdistrict->data]);
        }
        return view('seller.addressNew',["shop"=>[$shop],"provincies"=>$provincies->data]);
        
    }
    public function addAddress(Request $req){
        $shop = Shop::isExist(Session::get("id"));
        $req->merge(["shop_id"=>$shop->id]);
        $validatedData = $req->validate(Address::getValidationRules());
        $address = Address::addAddress($validatedData);
        if($address != null){
            return redirect('/seller/update')->withSuccess("Address successfully added");
        }
        return redirect()->back()->withErrors(["Add failed"]);
    }
    public function updateAddress(Request $req){
        $shop = Shop::isExist(Session::get("id"));
        $req->merge(["shop_id"=>$shop->id]);
        $validatedData = $req->validate(Address::getValidationRules());
        $result  = Address::updateAddress($shop->id,$validatedData);
        if($result!=null){
            return redirect('/seller/update')->withSuccess("Address successfully updated");
        }
        return redirect()->back()->withErrors(["Update failed"]);
    }
    public function process(Request $request){
        $shop=Shop::where("user_id",Session::get("id"))->first();
        if($shop->status == 0){
            $this->validate($request, [
                "name"=>"required|min:3|regex:/^\S*$/u",
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
                //insert data
                $shop->name = $request->name;
                $shop->description=$request->description;
                $shop->idcard_picture=$idcard_picture_name;
               $shop->save();
                return redirect()->back()->withSuccess("Wait admin for verify");
        }
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
        return redirect()->back()->withSuccess("shop information successfully updated");
    }
    public function address(){
        $shop=Shop::get()->where("id",Session::get("id"));
        return view('seller.address',['shop'=>$shop]);
    }

}
