<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_user as User;
use App\tb_address as Address;
use Session;

class manageUserProfileController extends Controller
{
    // load user data first
    public function index(){
        $user = User::where("id",Session::get("id"))->first();
        return view("buyer.profile.manageProfile",["data"=>$user]);
    }

    //name and phone number
    public function updateProfile(Request $req){
        $validatedData = $req->validate([
            "profile_picture"=>"",
            "name"=>User::getValidationRule("name")
        ]);
        $isNameSuccess = User::updateName(Session::get('id'),$validatedData['name']);
        $isPhotoSuccess = User::updateProfilePicture(Session::get('id'),$req);
        return redirect()->back()->withSuccess("Update Success");
    }


    public function addressIndex(Request $req){
        $addresses = '';
        return view("buyer.profile.manageAddress");
    }
    public function addAddress(Request $req){
        $req->merge(["user_id"=>Session::get("id")]);
        $validatedData = $req->validate(Address::getValidationRules());
        $address = Address::addAddress($validatedData);
        if($address){
            return redirect()->back()->withSuccess("Address added successfuly");
        }
        return redirect()->back()->withErrors(["Add address failed, please try again"]);
    }

    public function updateAddressIndex($id,Request $req){
        $address = Address::where("id",$id)->where("user_id",Session::get("id"))->first();
        if($address != null){
            return view("buyer.profile.editAddress",["data"=>$address]);
        }else{
            return redirect()->back()->withErrors(["address not exist"]);
        }
    }
    public function updateAddress(Request $req){
        $validatedData = $req->validate([
            "address_id"=>"required",
            "address_detail" => Address::getValidationRule("address_detail"),
            "province_id"=> Address::getValidationRule("province_id"),
            "city_id"=> Address::getValidationRule("city_id"),
            "subdistrict_id"=> Address::getValidationRule("subdistrict_id")
        ]);
        $result = Address::updateAddress($validatedData["address_id"],$validatedData);
        if($result){
            return redirect("/manage/address")->withSuccess("Update success");
        }
        return redirect()->back()->withErrors(["Update failed"]);
    }

    public function accountIndex(Request $req){
        $user = User::where("id",Session::get("id"))->first();
        return view("buyer.profile.manageAccount",["data"=>$user]);
    }
    public function updateEmail(Request $req){
        $validatedData = $req->validate([
            "email"=>User::getValidationRule("email"),
            "password"=>User::getValidationRule("password")
        ]);
        $result = User::updateEmail(Session::get("id"),$validatedData["email"],$validatedData["password"]);
        if($result){
            return redirect()->back()->withSuccess("Update success");
        }
        return redirect()->back()->withErrors(["Update failed"]);
    }
    public function updatePassword(Request $req){
        $validatedData = $req->validate([
            "password"=>User::getValidationRule("password"),
            "old_password"=>User::getValidationRule("password")
        ]);
        $result = User::updatePassword(Session::get("id"),$validatedData["password"],$validatedData["old_password"]);
        if($result){
            return redirect()->back()->withSuccess("Update success");
        }
        return redirect()->back()->withErrors(["Update failed"]);
    }
}
