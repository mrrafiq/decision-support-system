<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DecisionMaker;
use App\Models\UserCategories;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Ahp;

class AhpController extends Controller
{
    public function index($id)
    {
        $decision_maker = DecisionMaker::where('id', $id)->first();
        $user_categories = UserCategories::with('category')->where('user_id', Auth::user()->id)->get();
        $ahp = Ahp::where('decision_maker_id', $id)->get();

        if(count($ahp) != null){
            return redirect('/calculate');
        }
        // dd($decision_maker[1]->id);
        return view('calculate.weighting',[
            'title' => 'Calculate',
            'decision_maker' => $decision_maker,
            'user_categories' => $user_categories
        ]);
    }

    public function calculate(Request $request)
    {
        $data = $request->all();
        $items = [];
        foreach ($data as $data) {
            array_push($items, $data);
        }
        $user_categories = UserCategories::where('user_id', Auth::user()->id)->get();
        $decision_maker = DecisionMaker::where('user_id', Auth::user()->id)->get();
        $total_categories = count($user_categories);
        // dd($total_categories);

        for ($i=1; $i <= count($items)-1; $i++) {
            for ($j=2; $j <= $total_categories+1; $j++) {
                $check = Ahp::where('decision_maker_id', $items[1])
                        ->where('category_id', $items[$j])->get();
                if(count($check) == 0){
                    $ahp = new Ahp;
                    $ahp->decision_maker_id = $items[1];
                    $ahp->category_id = $items[$j];
                    // dd($j);
                    $weight = array();
                    $values = [];

                    //put AHP algorithm here!!
                    // $ahp->weight = 2;
                    for ($row=0; $row < $total_categories; $row++) {
                        if ($row == 0) {
                            for ($col=1; $col <= $total_categories; $col++) {
                                array_push($values, $col);
                            }
                            array_push($weight,$values);
                        }else {
                            for ($col=0; $col < $total_categories; $col++) {
                                if ($col == 0) {
                                    $next_data = number_format(($weight[0][$col])/($row+1), 2);

                                }else{
                                    $next_data = $weight[$row-1][$col-1];
                                    // dd($weight[$row-1][$col-1]);
                                }
                                array_push($values, $next_data);
                            }
                            array_push($weight,$values);
                        }
                        unset($values);
                        $values = array();
                    }
                    // dd($weight);
                    $total = [];
                    $temp_total = 0;
                    // count total for each weight vertical data
                    for ($y=0; $y < count($weight); $y++) {
                        for ($x=0; $x < count($weight); $x++) {
                            $temp_total = number_format($temp_total + $weight[$x][$y], 2);
                        }
                        array_push($total, $temp_total);
                        $temp_total = 0;
                    }

                    //normalized the data from $weight -> $weight[x][y]/$total[x]
                    $normalized = [];
                    $temp_normalized = [];
                    for ($x=0; $x < count($weight); $x++) {
                        for ($y=0; $y < count($weight); $y++) {
                            array_push($temp_normalized, $weight[$x][$y]/$total[$y]);
                        }
                        array_push($normalized, $temp_normalized);
                        unset($temp_normalized);
                        $temp_normalized = [];
                    }

                    //final calculated weight for each category
                    $weight_normalized = [];
                    for ($x=0; $x < count($weight); $x++) {
                        for ($y=0; $y < count($weight); $y++) {
                            $temp_total = $temp_total + $normalized[$x][$y];
                        }
                        $temp_total = $temp_total/count($weight);
                        array_push($weight_normalized, $temp_total);
                        $temp_total = 0;
                    }
                    // dd($weight);
                    $ahp->weight = $weight_normalized[$j-2];
                    $ahp->save();
                }
            }
        }
        // return redirect('/calculate/weighting/');

        //fetching all decision_maker id
        $data_id = [];
        for ($i=0; $i < count($decision_maker); $i++) {
            array_push($data_id, $decision_maker[$i]->id);
        }
        // dd($data_id);

        for ($i=0; $i < count($data_id); $i++) {
            if ($items[1] == $data_id[$i]) {
                if ($i == count($data_id)-1) {
                    return redirect('/calculate');
                }
                //return to next page
                // dd($data_id[1]);
                return redirect()->route('weighting', ['id' => $data_id[$i+1]]);
            }

        }


    }
}
