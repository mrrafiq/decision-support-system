<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CalculateController;
use App\Models\Aras;
use Illuminate\Support\Facades\Auth;
use App\Models\Ahp;
use App\Models\DecisionMakerStatus;
use App\Models\School;
use App\Models\UserCategories;
use App\Models\DecisionMaker;


class ArasController extends Controller
{
    public function index($id)
    {
        $user_categories = UserCategories::with('category')->where('user_id', Auth::user()->id)->get();
        $school = School::where('id', $id)->first();

        return view('calculate.alternate',[
            'title' => 'Calculate',
            'user_categories' => $user_categories,
            'school' => $school
        ]);
    }

    public function store(Request $request, $id)
    {
        // getting all request depends on total of user categories
        $data = $request->all();
        $items = [];
        foreach ($data as $key => $value) {
            $items[] = $value;
        }

        $decision_maker = DecisionMakerStatus::with('decision_maker')->latest()->first();
        $school = School::get();
        $user_categories = UserCategories::where('user_id', Auth::user()->id)->get();
        // dd($user_categories);
        for ($i=0; $i < count($user_categories); $i++) {
            $aras = new Aras;
            $aras->decision_maker_id = $decision_maker->decision_maker_id;
            $aras->category_id = $user_categories[$i]->category_id;
            $aras->school_id = $id;
            if ($user_categories[$i]->category_id == 1) {
                if ($items[$i+1] <= 2) {
                    $aras->value = 1;
                }
                elseif ($items[$i+1] <= 5) {
                    $aras->value = 2;
                }
                elseif ($items[$i+1] <= 10) {
                    $aras->value = 3;
                }
                elseif ($items[$i+1] <= 15) {
                    $aras->value = 4;
                }
                elseif ($items[$i+1] <= 20) {
                    $aras->value = 5;
                }
                elseif ($items[$i+1] <= 25) {
                    $aras->value = 6;
                }
                elseif ($items[$i+1] <= 30) {
                    $aras->value = 7;
                }
                elseif ($items[$i+1] <= 35) {
                    $aras->value = 8;
                }
                elseif ($items[$i+1] <= 40) {
                    $aras->value = 9;
                }
                else {
                    $aras->value = 10;
                }
            }else{
                $aras->value = $items[$i+1];
            }
            $aras->save();
        }

        $dm = DecisionMaker::where('user_id', Auth::user()->id)->get();
        $dm_data = [];
        foreach ($dm as $key => $value) {
            $dm_data [] = $value->id;
        }
        
        //redirecting to index because of total of the school that counted
        if ($id == count($school)) {
            $calculate = new CalculateController;
            $calculate->result($decision_maker->decision_maker_id);
            return redirect()->route('direction',['id' => ($decision_maker->decision_maker_id)+1]);
        }

        return redirect()->route('alternate', ['id' => $id+1]);
    }

    public function direction($id)
    {
        $decision_maker = DecisionMaker::where('id', $id)->first();

        $aras = Aras::where('decision_maker_id', $id)->get();

        if(count($aras) == null){
            $decision_maker = DecisionMaker::where('id', $id)->first();
            if ($decision_maker == null) {
                return redirect('/calculate');
            }
        }

        // to check is there any data in aras table
        if(count($aras) != null){
            $calculate = new CalculateController;
            $calculate->result($id);
        }
        return view('calculate.direction',[
            'title' => 'Calculate',
            'data' => $decision_maker,
        ]);
    }

    public function setDecisionMaker(Request $request, $id)
    {
        $decision_maker = DecisionMaker::where('user_id', Auth::user()->id)->get();
        $school = School::get();
        $latest_decision_maker = DecisionMaker::where('user_id', Auth::user()->id)->max('id');
        $arr_data = [];
        for ($i=0; $i < count($decision_maker); $i++) {
            array_push($arr_data, $decision_maker[$i]->id);
        }
        // dd($arr_data);

        for ($i=0; $i < count($arr_data); $i++) {
            if (in_array($request->decision_maker_id, $arr_data)) {
                if ($i == count($arr_data)-1) {
                    return redirect('/calculate');
                }
                // sending data decision maker status to database
                $status = new DecisionMakerStatus;
                $status->decision_maker_id = $request->decision_maker_id;
                $status->save();
                return redirect()->route('alternate', ['id' => $school[$i]->id]);
            }
            elseif($request->decision_maker_id == 0){
                //return to next page
                if(in_array($id+1, $arr_data)){
                    return redirect()->route('direction', ['id' => $id+1]);
                }
                elseif($latest_decision_maker == $id){
                    return redirect()->route('direction', ['id' => $arr_data[0]]);
                }
                return redirect()->route('direction', ['id' => $arr_data[$id]]);
            }

        }

    }



}
