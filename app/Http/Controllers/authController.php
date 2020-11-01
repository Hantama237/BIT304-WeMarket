<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_user as User;
use Session;
use App\tb_email_verification as Verification; 

class authController extends Controller
{
    //
    public function loginIndex(){
        return view("auth.login");
    }
    public function registerIndex(){
        return view("auth.register");
    }

    public function login(Request $req){
        $validatedData = $req->validate([
            "email"=>User::getValidationRule("email"),
            "password"=>User::getValidationRule("password")
        ]);
        $user = User::login($validatedData["email"],$validatedData["password"]);
        if($user){
            Session::put([
                "login"=>true,
                "id"=>$user->id,
                "name"=>$user->name,
                "profile_picture"=>$user->profile_picture,
                "shop"=>false
            ]);
            
            return redirect("/");
        }
        return redirect()->back()->withErrors(["Incorrect email/password"]);
    }
    public function register(Request $req){
        $validatedData = $req->validate(User::getValidationRules());
        $user = User::register($validatedData);
        if($user){
            Session::put([
                "login"=>true,
                "id"=>$user->id,
                "name"=>$user->name,
                "profile_picture"=>$user->profile_picture,
                "shop"=>false
            ]);
            Verification::sendVerificationCode($user);
            return redirect("/");
        }
        return redirect()->back()->withErrors(["Register failed, please try again"]);
    }

    public function logout(){
        Session::flush();
        return redirect("/login");
    }
}
