<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_admin as Admin;
use Session;
class adminController extends Controller
{
    public function login(Request $req){
        $validatedData = $req->validate(Admin::getValidationRules());
        $admin = Admin::login($validatedData["username"],$validatedData["password"]);
        //dd($admin);
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
}
