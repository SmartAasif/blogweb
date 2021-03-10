<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Validator;

class SignupController extends Controller
{
    //
    function userRegister(Request $req)
    {
        $this->validate($req,[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|alphaNum|min:3',
            'confirm_password' => 'required_with:password|same:password|min:3'
        ]);
        $user=new User();
        $user->name=$req->input('name');
        $user->email=$req->input('email');
        $user->password=$req->input('password');
        //$con_password=$req->input('con-password');
        $user->save();
        $data=$req->input();
        $req->session()->put('email',$data['email']);
        return redirect('postlist');
        
    }
}
