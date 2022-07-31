<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DecisionMaker;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DecisionMakerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = DecisionMaker::with('user')->get();
        $data = DecisionMaker::with(['user', 'session'])->get();
        return view('/decision-maker/index',[
            'title' => 'Decision Maker',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/decision-maker/create',[
            'title' => 'Decision Maker'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:8'
        ]);

        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->assignRole(2);
        $user->save();

        $new = User::latest()->first();
        $dm = new DecisionMaker;
        $dm->user_id = $new->id;
        $dm->session_id = null;
        $dm->save();
        return redirect('/decision-maker');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DecisionMaker::where('user_id', $id)->first();
        $user = User::where('id', $id)->first();
        return view('decision-maker.edit', [
            'data' => $data,
            'user' => $user,
            'title' => 'Decision Maker'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $user->username = $request->username;
        $user->email = $request->email;
        if($request->password != ""){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect('/decision-maker');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->delete();
        return redirect('/decision-maker');
    }
}
