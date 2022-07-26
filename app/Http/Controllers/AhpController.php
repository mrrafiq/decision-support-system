<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DecisionMaker;
use App\Models\UserCategories;
use App\Models\Scale;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Ahp;

class AhpController extends Controller
{
    public function index($id)
    {
        $decision_maker = DecisionMaker::where('id', $id)->first();
        $user_categories = UserCategories::with(['category'])->where('user_id', Auth::user()->id)->get();
        $ahp = Ahp::where('decision_maker_id', $id)->get();
        $scale = Scale::get();
        // dd($user_categories);

        if(count($ahp) != null){
            return redirect('/calculate');
        }
        // dd($decision_maker[1]->id);
        return view('calculate.weighting',[
            'title' => 'Calculate',
            'decision_maker' => $decision_maker,
            'user_categories' => $user_categories,
            'scale' => $scale
        ]);
    }

    public function calculate(Request $request, $id)
    {
        $data = $request->all();
        $items = [];
        foreach ($data as $key => $value) {
            $items[] = $value;
        }

        $user_categories = UserCategories::where('user_id', Auth::user()->id)->get();
        $decision_maker = DecisionMaker::where('user_id', Auth::user()->id)->get();
        $total_categories = count($user_categories);

        //getting data from request and place it into an array
        $i = 1;
        $j = 1;
        $values =[];
        while ($i < count($items)) {
            $temp = [];
            $counter = $i+$total_categories-$j;
            if ($i == $counter) {
                array_push($temp, $items[$counter-1]);
            }
            for ($k=$i; $k < $counter; $k++) {
                array_push($temp, $items[$k]);
            }
            array_push($values, $temp);
            unset($temp);
            $i = $i+$total_categories-$j;
            $j = $j+1;
        }
        unset($i);
        unset($j);

        // filling another empty spot in $values array
        for ($i=0; $i < count($values); $i++) {
            for ($j=0; $j < count($values); $j++) {
                if ($j == $i) {
                    array_splice($values[$i],$j,0,1);
                }
                if($j > $i){
                    $temp = 1/$values[$i][$j];
                    array_splice($values[$j],$i,0, $temp);
                }
            }
        }
        $temp =[];
        for ($i=0; $i < count($values); $i++) {
            array_push($temp, 1/$values[$i][count($values[$i])-1]);
        }
        array_push($temp, 1);
        array_push($values, $temp);
        unset($temp);

        //get the total of each category vertically
        $total =[];
        for ($i=0; $i < count($values); $i++) {
            $temp = 0;
            for ($j=0; $j < count($values); $j++) {
                $temp += $values[$j][$i];
            }
            array_push($total, $temp);
            unset($temp);
        }

        // $total array is to help normalizing $values array without put it inside $values array
        //normalize $values
        $normalized = [];
        for ($i=0; $i < count($values); $i++) {
            $temp = [];
            for ($j=0; $j < count($values); $j++) {
                array_push($temp, $values[$i][$j]/$total[$j]);
            }
            array_push($normalized, $temp);
        }

        //Make $values array is same as $normalized
        $values = $normalized;

        //find weight of each category
        $weight = [];
        for ($i=0; $i < count($values); $i++) {
            $temp = 0;
            for ($j=0; $j < count($values); $j++) {
                $temp += $values[$i][$j];
            }
            $temp = $temp/count($values);
            array_push($weight, $temp);
            unset($temp);
        }

        // verify that the calculation is in range off error tolerance
        // (CR <= 0.1) ? true : false

        //find lmax for each category
        $lmax = [];
        for ($i=0; $i < count($values); $i++) {
            $temp = $total[$i] * $weight[$i];
            array_push($lmax, $temp);
        }
        unset($temp);

        // calculating for CI
        $lmax_total = 0;
        for ($i=0; $i < count($values); $i++) {
            $lmax_total += $lmax[$i];
        }

        $ci = ($lmax_total - count($values)) / (count($values) - 1);
        $ir = [0, 0, 5.8, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49];

        $cr = $ci/$ir[count($values)-1];

        // conditioning if CR <= 0.1
        if ($cr <= 0.1) {
            for ($i=0; $i < count($values); $i++) {
                $ahp = new Ahp;
                $ahp->decision_maker_id = $id;
                $ahp->category_id = $user_categories[$i]->category_id;
                $ahp->weight = $weight[$i];
                $ahp->save();
            }
            // //fetching all decision_maker id
            $data_id = [];
            for ($i=0; $i < count($decision_maker); $i++) {
                array_push($data_id, $decision_maker[$i]->id);
            }
            // dd($decision_maker);

            for ($i=0; $i < count($data_id); $i++) {
                if ($id == $data_id[$i]) {
                    if ($i == count($data_id)-1) {
                        return redirect('/calculate');
                    }
                    //return to next page
                    // dd($data_id[1]);
                    return redirect()->route('weighting', ['id' => $data_id[$i+1]]);
                }

            }
        }
        else{
            return redirect()->route('weighting', ['id' => $id])->with('error', 'Data yang anda inputkan tidak konsisten. Harap lakukan input dengan penuh pertimbangan!');
        }
    }
}
