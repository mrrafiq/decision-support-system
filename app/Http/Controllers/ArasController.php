<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aras;
use Illuminate\Support\Facades\Auth;
use App\Models\Ahp;
use App\Models\DecisionMakerStatus;
use App\Models\School;
use App\Models\UserCategories;


class ArasController extends Controller
{
    public function index($id)
    {
        $decision_maker = DecisionMakerStatus::with('decision_maker')->latest()->first();
        $user_categories = UserCategories::with('category')->where('user_id', Auth::user()->id)->get();
        $school = School::where('id', $id)->first();

        // dd($decision_maker);

        return view('calculate.alternate',[
            'title' => 'Calculate',
            'decision_maker' => $decision_maker,
            'user_categories' => $user_categories,
            'school' => $school
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $decision_maker_id = $request->decision_maker_id;
        $school_id = $request->school_id;
        for ($i=0; $i < count($request->all()); $i++) { 
            if ($i == 0) {
                $aras = new Aras;
                $aras->decision_maker_id = $decision_maker_id;
                $aras->school_id = $school_id;
                $aras->category_id = $request->category_id_0;
                $aras->value = $request->value_0;
            }
            elseif ($i == 1) {
                $aras = new Aras;
                $aras->decision_maker_id = $decision_maker_id;
                $aras->school_id = $school_id;
                $aras->category_id = $request->category_id_1;
                $aras->value = $request->value_1;
            }
            elseif ($i == 2) {
                $aras = new Aras;
                $aras->decision_maker_id = $decision_maker_id;
                $aras->school_id = $school_id;
                $aras->category_id = $request->category_id_2;
                $aras->value = $request->value_2;
            }
            elseif ($i == 3) {
                $aras = new Aras;
                $aras->decision_maker_id = $decision_maker_id;
                $aras->school_id = $school_id;
                $aras->category_id = $request->category_id_3;
                $aras->value = $request->value_3;
            }
            elseif ($i == 4) {
                $aras = new Aras;
                $aras->decision_maker_id = $decision_maker_id;
                $aras->school_id = $school_id;
                $aras->category_id = $request->category_id_4;
                $aras->value = $request->value_4;
            }
            elseif ($i == 5) {
                $aras = new Aras;
                $aras->decision_maker_id = $decision_maker_id;
                $aras->school_id = $school_id;
                $aras->category_id = $request->category_id_5;
                $aras->value = $request->value_5;
            }
            elseif ($i == 6) {
                $aras = new Aras;
                $aras->decision_maker_id = $decision_maker_id;
                $aras->school_id = $school_id;
                $aras->category_id = $request->category_id_6;
                $aras->value = $request->value_6;
            }
            elseif ($i == 7) {
                $aras = new Aras;
                $aras->decision_maker_id = $decision_maker_id;
                $aras->school_id = $school_id;
                $aras->category_id = $request->category_id_7;
                $aras->value = $request->value_7;
            }
            elseif ($i == 8) {
                $aras = new Aras;
                $aras->decision_maker_id = $decision_maker_id;
                $aras->school_id = $school_id;
                $aras->category_id = $request->category_id_8;
                $aras->value = $request->value_8;
            }
            elseif ($i == 9) {
                $aras = new Aras;
                $aras->decision_maker_id = $decision_maker_id;
                $aras->school_id = $school_id;
                $aras->category_id = $request->category_id_9;
                $aras->value = $request->value_9;
            }
            $aras->save();
        }
        // return redirect()->route('alternate', ['id' => $school_id+1]);
        return redirect('/calculate');
    }

    public function direction()
    {
        $decision_maker = Ahp::with('decision_maker')->join('decision_makers', 'ahp.decision_maker_id', '=', 'decision_makers.id')
                        ->select('ahp.decision_maker_id', 'decision_makers.name')
                        ->where('decision_makers.user_id', Auth::user()->id)
                        ->distinct()->get();
        for($i = 0; $i < count($decision_maker); $i++) {
            $check = Aras::where('decision_maker_id', $decision_maker[$i]->decision_maker_id)->get();
            if ($check == null) {
                return view('calculate.direction',[
                    "title" => "Calculate",
                    "data" => $decision_maker[$i]
                ]);
            }
            else {
                return view('calculate.direction',[
                    "title" => "Calculate",
                    "data" => $decision_maker[$i+1]
                ]);
            }
        }
        return redirect('/calculate');
    }

    public function setDecisionMaker(Request $request)
    {
        $decision_maker = Ahp::with('decision_maker')->join('decision_makers', 'ahp.decision_maker_id', '=', 'decision_makers.id')
                        ->select('ahp.decision_maker_id', 'decision_makers.name')
                        ->where('decision_makers.user_id', Auth::user()->id)
                        ->distinct()->get();
        
        $arr_data = [];
        for ($i=0; $i < count($decision_maker); $i++) { 
            array_push($arr_data, $decision_maker[$i]->decision_maker_id);
            if(in_array($request->decision_maker_id, $arr_data)){
                $status = new DecisionMakerStatus;
                $status->decision_maker_id = $request->decision_maker_id;
                $status->save();
                
                return redirect('/calculate/alternate/1');
            }
        }
    }

    public function skipDecisionMaker(Request $request)
    {
        $decision_maker = Ahp::with('decision_maker')->join('decision_makers', 'ahp.decision_maker_id', '=', 'decision_makers.id')
                        ->select('ahp.decision_maker_id', 'decision_makers.name')
                        ->where('decision_makers.user_id', Auth::user()->id)
                        ->distinct()->get();
        
        for ($i=0; $i < count($decision_maker); $i++) { 
            $check = Aras::where('decision_maker_id', $decision_maker[$i]->decision_maker_id)->get();
            if ($request->decision_maker_id == $decision_maker[$i]->decision_maker_id) {
                // dd($check);
                if ($check == null) {
                    return view('calculate.direction',[
                        "title" => "Calculate",
                        "data" => $decision_maker[$i+1]
                    ]);
                }
            }else{
                if ($check ==null) {
                    dd($decision_maker[$i]);
                    return view('calculate.direction',[
                        "title" => "Calculate",
                        "data" => $decision_maker[$i]
                    ]);
                }
                else {
                    return view('calculate.direction',[
                        "title" => "Calculate",
                        "data" => $decision_maker[$i+1]
                    ]);
                }
            }
        }
    }

    /**This function is to display each school data and user could input the value and 
     * calculate it with ARAS method
    */
    public function show(Request $request, $id)
    {
        // $decision_maker
        
        // return view('calculate.show'. [
        //     'title' => 'Calculate',
        //     'decision_maker' => $decision_maker
        // ]);
    }

    public function verify(Request $request)
    {

    }

    
}
