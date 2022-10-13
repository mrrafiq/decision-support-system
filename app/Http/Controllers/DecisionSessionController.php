<?php

namespace App\Http\Controllers;

use App\Models\DecisionSession;
use App\Models\DecisionMaker;
use App\Models\Borda;
use App\Models\Aras;
use App\Models\Ahp;
use App\Models\Calculate;
use App\Models\UserCategories;
use App\Models\SchoolSession;
use Illuminate\Http\Request;

class DecisionSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DecisionSession::get();
        return view('decision-session.index',[
            'title' => 'Sessions',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('decision-session.create', [
            'title' => 'Sessions'
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
        $session = new DecisionSession;
        $session->name = $request->name;
        $session->save();
        return redirect('/decision-session');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DecisionSession  $decisionSession
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decision_maker = DecisionMaker::with('user')->where('session_id', $id)->get();
        $session = DecisionSession::where('id', $id)->first();
        $borda = Borda::with('school')->where('session_id', $id)->get();
        $school = SchoolSession::where('session_id', $id)->get();
        // dd($school);

        $weight = null;
        $message = null;
        foreach($decision_maker as $key){
            $weight += $key->weight;
        }
        if ($weight < 1) {
            $message = "Pastikan jumlah bobot decision maker mencapai angka 1! Perhitungan Belum Dapat Dilakukan!";
        }
        return view('decision-session.show', [
            'title' => 'Sessions',
            'session' => $session,
            'data' => $decision_maker,
            'borda' => $borda,
            'school' => $school,
            'message' => $message
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DecisionSession  $decisionSession
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $session = DecisionSession::where('id', $id)->first();
        return view('decision-session.edit', [
            'title' => 'Sessions',
            'data' => $session
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DecisionSession  $decisionSession
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $session = DecisionSession::where('id', $id)->first();
        $session->name = $request->name;
        $session->save();
        return redirect('/decision-session');
    }

    public function addDecisionMaker($id)
    {
        $data = DecisionMaker::whereNot('session_id', $id)->orWhere('session_id', null)->get();
        $session = DecisionSession::where('id', $id)->first();
        return view('decision-session.add-decision-maker',[
            'title' => 'Sessions',
            'data' => $data,
            'session' => $session
        ]);
    }

    public function storeDecisionMaker(Request $request, $id)
    {
        $data = [];
        foreach ($request->all() as $key => $value) {
           $data [] = $value;
        }

        for ($i=1; $i <= count($data)-1; $i++) {
            $input = DecisionMaker::where('user_id', $data[$i])->first();
            $input->session_id = $id;
            $input->weight = null;
            $input->save();
        }

        return redirect()->route('show-decision-session', ['id' => $id]);
    }

    public function editDecisionMaker($id)
    {
        $data = DecisionMaker::where('id', $id)->first();
        $session = DecisionSession::get();

        return view('decision-session.edit-decision-maker', [
            'title' => 'Sessions',
            'data' => $data,
            'session' => $session,
        ]);
    }

    public function updateDecisionMaker(Request $request, $id)
    {
        $dm = DecisionMaker::where('id', $id)->first();

        //convert data type from string into double
        $weight = str_replace(',','.', $request->weight);

        //check the capability of max number of weight
        $check = DecisionMaker::where('session_id', $request->session_id)->whereNot('id', $id)->get();
        $count = null;
        foreach ($check as $key) {
            $count += $key->weight;
        }
        $count += $request->weight;

        if ($count <= 1) {
            $dm->session_id = $request->session_id;
            $dm->weight = $weight;
            $dm->save();
            return redirect()->route('show-decision-session', ['id' => $request->session_id]);
        }
        else{
            return redirect()->route('edit-dm-session', ['id' => $id])->with('error', 'Jumlah nilai bobot harus bernilai <1.');
        }
    }

    public function deleteDecisionMaker($id)
    {
        $dm = DecisionMaker::where('id', $id)->first();


        Aras::where('decision_maker_id', $id)->where('session_id', $dm->session_id)->delete();
        // $aras->delete();

        Ahp::where('decision_maker_id', $id)->where('session_id', $dm->session_id)->delete();
        // $ahp->delete();

        Calculate::where('decision_maker_id', $id)->where('session_id', $dm->session_id)->delete();
        // $calculate->delete();

        $dm->session_id = null;
        $dm->save();
        return redirect('decision-session');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DecisionSession  $decisionSession
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dm = DecisionMaker::where('session_id', $id)->get();
        $collection = [];
        foreach ($dm as $key => $value) {
            $collection [] = $value->id;
        }
        for ($i=0; $i < count($collection); $i++) {
            $data = DecisionMaker::where('id', $collection[$i])->first();
            $data->session_id = null;
            $data->save();
        }
        $session = DecisionSession::where('id', $id)->first();
        $session->delete();
        return redirect('/decision-session');
    }
}
