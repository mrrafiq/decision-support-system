<?php

namespace App\Http\Controllers;

use App\Models\Calculate;
use App\Models\DecisionMaker;
use App\Models\UserCategories;
use App\Models\Ahp;
use App\Models\Aras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CalculateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Calculate::where('user_id', Auth::user()->id)->get();
        $ahp = Ahp::join('decision_makers', 'ahp.decision_maker_id', '=', 'decision_makers.id')
                ->where('decision_makers.user_id', Auth::user()->id)->get();
        $decision_maker_total = DecisionMaker::where('user_id', Auth::user()->id)->get();
        $arr_data = [];
        foreach($decision_maker_total as $key){
            $arr_data[] = $key->id;
        }

        for ($i=0; $i < count($arr_data); $i++) {
            $aras = Aras::where('decision_maker_id', $arr_data[$i])->get();
            if (count($aras) == null) {
                $decision_maker = DecisionMaker::where('id', $arr_data[$i])->first();
                return view('calculate.index',[
                    'title' => 'Calculate',
                    'data' => $decision_maker,
                    'aras' => $aras,
                    'decision_maker' => $decision_maker_total,
                    'ahp' => $ahp,
                ], compact('data'));
            }
        }
        $aras = Aras::join('decision_makers', 'aras.decision_maker_id', '=', 'decision_makers.id')
                ->whereIn('decision_makers.id', $arr_data)->get();
        // dd($aras);
        return view('calculate.index',[
            'title' => 'Calculate',
            'aras' => $aras,
            'decision_maker' => $decision_maker_total,
            'ahp' => $ahp,
        ], compact('data'));
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
     * @param  \App\Models\Calculate  $calculate
     * @return \Illuminate\Http\Response
     */
    public function show(Calculate $calculate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Calculate  $calculate
     * @return \Illuminate\Http\Response
     */
    public function edit(Calculate $calculate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Calculate  $calculate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calculate $calculate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Calculate  $calculate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calculate $calculate)
    {
        //
    }
}
