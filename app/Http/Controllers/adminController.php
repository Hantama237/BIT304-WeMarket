<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_admin as Admin;
use App\tb_shop as Shop;
use Session;
class adminController extends Controller
{
    public function login(Request $req){
        $validatedData = $req->validate(Admin::getValidationRules());
        $admin = Admin::login($validatedData["username"],$validatedData["password"]);
        if($admin){
            Session::put([
                "admin"=>true
            ]);
            return redirect("/admin/home");
        }
        return redirect()->back()->withErrors(["Incorrect email/password"]);
    }

    public function loginPage(){
        return view("admin.login");
    }

    public function home(){
        return view("admin.home");
    }
    public function verify(){
        $shop= Shop::where("status",0)->get();
      
        return view("admin.verifySeller",['shop'=>$shop]);
    }
    public function process($id){
        $shop= Shop::find($id);
        $shop->status = 1;
        $shop->save();
        // dd($shop->status);
      
        return redirect()->back();
    }
}
