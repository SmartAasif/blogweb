<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;

class UserAuth extends Controller
{
    //
    function userLogin(Request $req )
    {

        //echo session('user');
        $this->validate($req,[
            'email'=>'required',
            'password'=>'required|min:3'
        ]);
        $username=$req->input('email');
        $password=$req->input('password');
        $checkLogin=DB::table('users')->where(['email'=>$username,'password'=>$password])->get();
        if(count($checkLogin)>0)
        {

        $data=$req->input();
        $req->session()->put('email',$data['email']);

        return redirect('postlist');
        // echo session('email');

        }
        else
        {
            //echo "incorrect credentials";
            return back()->with('error','Invalid username or password');
            //return redirect('login');
        }
    }
    
}
