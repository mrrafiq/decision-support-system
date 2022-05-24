<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Auth;
use Session;

class AuthController extends Controller
{
    public function login(Request $request){
        if(Auth::attempt($request->only('email','password'))){
            return redirect('/');
        }
        
        Session::flash('error', 'Email atau Password salah');
        return redirect('/login');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
