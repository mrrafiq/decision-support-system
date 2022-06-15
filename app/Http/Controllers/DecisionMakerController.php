<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DecisionMaker;
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
        $decision_maker = new DecisionMaker;
        $data = DecisionMaker::get();
        return view('/decision-maker/index',[
            'title' => 'Decision Maker'
        ], compact('data'));
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
            'name' => 'required|unique:decision_makers,name'
        ]);

        $decision_maker = new DecisionMaker;
        $decision_maker->name = $request->name;
        $decision_maker->user_id = Auth::user()->id;
        $decision_maker->save();
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
        $data = DecisionMaker::where('id', $id)->first();
        return view('decision-maker.edit', [
            'data' => $data,
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
        $this->validate($request, [
            'name' => 'required|unique:decision_makers,name'
        ]);

        $decision_maker = DecisionMaker::findOrFail($id);
        $decision_maker->name = $request->name;
        $decision_maker->user_id = Auth::user()->id;
        $decision_maker->save($request->all());
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
        $decision_maker = DecisionMaker::where('id', $request->id)->first();
        $decision_maker->delete();
        return redirect('/decision-maker');
    }
}
