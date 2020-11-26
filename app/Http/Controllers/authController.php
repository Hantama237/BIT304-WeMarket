<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\tb_user as User;
use Session;
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
        $banned_days = now()->diffInDays($user->banned_until);
        // dd($banned_days);
        
        if($user->banned_until == null){
            Session::put([
                "login"=>true,
                "id"=>$user->id,
                "name"=>$user->name,
                "profile_picture"=>$user->profile_picture,
                "shop"=>false
            ]);
            return redirect("/");
        }
        if($user->banned_until != null){
            if ($banned_days > 14) {
                $message = 'Your account has been suspended. Please contact administrator for more info.';
            } else {
                $message = 'Your account has been suspended for '.$banned_days.' '.Str::plural('day', $banned_days).'. Please contact administrator.';
            }

            return redirect("/login")->withMessage($message);
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
            return redirect("/");
        }
        return redirect()->back()->withErrors(["Register failed, please try again"]);
    }

    public function logout(){
        Session::flush();
        return redirect("/login");
    }
}
