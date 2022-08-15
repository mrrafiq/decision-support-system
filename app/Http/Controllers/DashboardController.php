<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CalculateController;
use Illuminate\Support\Facades\Auth;
use App\Models\Borda;
use App\Models\DecisionMaker;
use App\Models\UserCategories;
use App\Models\DecisionSession;
use App\Models\School;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dm = DecisionMaker::with('user')->where('user_id', Auth::user()->id)->first();
        $borda = null;
        if($dm !== null){
            $borda = Borda::with('school')->where('session_id', $dm->session_id)->get();
            $user_categories = UserCategories::with('session', 'category')->where('session_id', $dm->session_id)->get();
            $session = [];

            return view('dashboard/index', [
                'title' => 'Dashboard',
                'categories' => $user_categories,
                'session' => $session,
                'dm' => $dm,
                'data' => $borda
            ]);
        }
        else{
            $session = DecisionSession::select('id')->get();
            $borda = Borda::join('decision_sessions', 'borda.session_id', '=', 'decision_sessions.id')->select('decision_sessions.id', 'decision_sessions.name')->groupBy('decision_sessions.name', 'decision_sessions.id')->whereIn('session_id', $session)->get();
            $user_categories = [];
            $dm_total = DecisionMaker::get();
            $school = School::count();

            return view('dashboard/index', [
                'title' => 'Dashboard',
                'data' => $borda,
                'dm' => 'Admin',
                'categories' => $user_categories,
                'session' => $session,
                'dm_total' => $dm_total,
                'school' => $school
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
