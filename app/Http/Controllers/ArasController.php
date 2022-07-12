<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function store(Request $request, $id)
    {
        // dd($request->all());
        $decision_maker_id = $request->decision_maker_id;
        $school_id = $request->school_id;
        $school = School::get();
        $user_categories = UserCategories::where('user_id', Auth::user()->id)->get();

        // getting all request depends on total of user categories
        for ($i = 0; $i < count($user_categories); $i++) {
            if ($i == 0) {
                $aras = new Aras;
                $aras->decision_maker_id = $decision_maker_id;
                $aras->school_id = $school_id;
                $aras->category_id = $request->category_id_0;
                $aras->value = $request->value_0;
                $aras->save();
            }
            elseif ($i == 1) {
                $aras = new Aras;
                $aras->decision_maker_id = $decision_maker_id;
                $aras->school_id = $school_id;
                $aras->category_id = $request->category_id_1;
                $aras->value = $request->value_1;
                $aras->save();
            }
            elseif ($i == 2) {
                $aras = new Aras;
                $aras->decision_maker_id = $decision_maker_id;
                $aras->school_id = $school_id;
                $aras->category_id = $request->category_id_2;
                $aras->value = $request->value_2;
                $aras->save();
            }
            elseif ($i == 3) {
                $aras = new Aras;
                $aras->decision_maker_id = $decision_maker_id;
                $aras->school_id = $school_id;
                $aras->category_id = $request->category_id_3;
                $aras->value = $request->value_3;
                $aras->save();
            }
            elseif ($i == 4) {
                $aras = new Aras;
                $aras->decision_maker_id = $decision_maker_id;
                $aras->school_id = $school_id;
                $aras->category_id = $request->category_id_4;
                $aras->value = $request->value_4;
                $aras->save();
            }
            elseif ($i == 5) {
                $aras = new Aras;
                $aras->decision_maker_id = $decision_maker_id;
                $aras->school_id = $school_id;
                $aras->category_id = $request->category_id_5;
                $aras->value = $request->value_5;
                $aras->save();
            }
            elseif ($i ==6) {
                $aras = new Aras;
                $aras->decision_maker_id = $decision_maker_id;
                $aras->school_id = $school_id;
                $aras->category_id = $request->category_id_6;
                $aras->value = $request->value_6;
                $aras->save();
            }
            elseif ($i == 7) {
                $aras = new Aras;
                $aras->decision_maker_id = $decision_maker_id;
                $aras->school_id = $school_id;
                $aras->category_id = $request->category_id_7;
                $aras->value = $request->value_7;
                $aras->save();
            }
            elseif ($i == 8) {
                $aras = new Aras;
                $aras->decision_maker_id = $decision_maker_id;
                $aras->school_id = $school_id;
                $aras->category_id = $request->category_id_8;
                $aras->value = $request->value_8;
                $aras->save();
            }
            elseif ($i == 9) {
                $aras = new Aras;
                $aras->decision_maker_id = $decision_maker_id;
                $aras->school_id = $school_id;
                $aras->category_id = $request->category_id_9;
                $aras->value = $request->value_9;
                $aras->save();
            }
        }

        //redirecting to index because of total of the school that counted
        if ($id == count($school)) {
            return redirect()->route('direction',['id' => $decision_maker_id+1]);
        }
        return redirect()->route('alternate', ['id' => $id+1]);
    }

    public function direction($id)
    {
        $decision_maker = DecisionMaker::where('id', $id)->first();
        // $arr_data= [];
        // foreach ($decision_maker as $key) {
        //     $arr_data[] = $key->id;
        // }

        // $decision_maker_aras = Aras::whereNotIn('decision_maker_id', $arr_data)->get();
        // dd($decision_maker_aras);

        // if (count($decision_maker_aras) == null) {
        //     $decision_maker = DecisionMaker::where('id', $id)->first();

        // }

        $aras = Aras::where('decision_maker_id', $id)->get();

        if($decision_maker == null){
            $decision_maker = DecisionMaker::where('id', $id+1)->first();
            if ($decision_maker == null) {
                return redirect('/calculate');
            }
        }

        // to check is there any data in aras table
        if(count($aras) != null){
            return redirect('/calculate');
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
                // dd($latest_decision_maker);
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
