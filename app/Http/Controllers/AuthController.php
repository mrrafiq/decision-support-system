<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\DecisionMaker;
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

    public function index(){
        return view('/auth/login');
    }

    public function create(){
        return view('/auth/register');
    }

    public function store(Request $request){
        $this->validate($request,[
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:8'
        ]);

        $user = new User;
        if($request->password == $request->password_confirm){
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->assignRole(2);
            $user->save();

            $new = User::latest()->first();
            $dm = new DecisionMaker;
            $dm->user_id = $new->id;
            $dm->session_id = null;
            $user->weight = null;
            $dm->save();
            return view('/auth/login');
        }else{
            Session::flash('error', 'Pastikan password konfirmasi benar!');
            return redirect('/register');
        }
    }
}
