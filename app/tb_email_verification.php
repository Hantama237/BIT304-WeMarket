<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class tb_email_verification extends Model
{
    protected $guarded = ["id"];
    //
    public static function sendVerificationCode($user){
        //untuk buat kode verifikasi
        $code = substr(str_shuffle("0123456789"), 0, 5);
        //simpan kode verifikasi
        self::create(["code"=>$code,"user_id"=>$user->id]);
        //kirim email verifikasi
        $to_name = $user->name;
        $to_email = $user->email;
        $data = array("name"=>$user->name,"verification_code"=>$code, "link"=> "http://127.0.0.1:8000/verify/");
        $mail = Mail::send("mail", $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
            ->subject("Verify Your Email");
            $message->from('guardtama237@gmail.com',"WeMarket");
        });
        return $mail;
    }
}
