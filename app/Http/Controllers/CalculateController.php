<?php

namespace App\Http\Controllers;

use App\Models\Calculate;
use App\Models\DecisionMaker;
use App\Models\UserCategories;
use App\Models\Ahp;
use App\Models\Aras;
use App\Models\School;
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
        $ahp = Ahp::join('decision_makers', 'ahp.decision_maker_id', '=', 'decision_makers.id')
                ->where('decision_makers.user_id', Auth::user()->id)->get();
        $decision_maker_total = DecisionMaker::where('user_id', Auth::user()->id)->get();
        $arr_data = [];
        foreach($decision_maker_total as $key){
            $arr_data[] = $key->id;
        }
        $result = $this->result(1);
        $data = Calculate::join('decision_makers', 'calculates.decision_maker_id', '=', 'decision_makers.id')
                ->where('decision_makers.user_id', Auth::user()->id)->get();
        // dd($data);

        // dd($result);

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
                ]);
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
        ]);
    }

    public function result($id)
    {
        $schools = School::get();
        $categories = UserCategories::where('user_id',  Auth::user()->id)->get();
        $decision_makers = DecisionMaker::where('id', $id)->first();
        $arr_row = [];
        for ($i=0; $i < count($schools); $i++) {
            $arr_col = [];
            for ($j=0; $j < count($categories); $j++) {
                $aras = Aras::where('decision_maker_id', $decision_makers->id)
                        ->where('category_id', $categories[$j]->category_id)
                        ->where('school_id', $schools[$i]->id)
                        ->first();
                array_push($arr_col, $aras->value);
            }
            array_push($arr_row, $arr_col);
            unset($arr_col);
        }

        $arr_null = [];
        // calling type value of each user categories
        $type = UserCategories::join('categories', 'user_categories.category_id', '=', 'categories.id')
                    ->where('user_id', Auth::user()->id)
                    ->get();
        //find max or min of each data in $arr_row then add it into $arr_null
        for ($i=0; $i < count($categories); $i++) {
            $arr_temp = [];
            if($type[$i]->type == 0){
                for ($j=0; $j < count($schools); $j++) {
                    array_push($arr_temp,$arr_row[$j][$i]);
                }
                array_push($arr_null, min($arr_temp));
            }
            if($type[$i]->type == 1){
                for ($j=0; $j < count($schools); $j++) {
                    array_push($arr_temp,$arr_row[$j][$i]);
                }
                array_push($arr_null, max($arr_temp));
            }

            unset($arr_temp);
        }
        //combining $arr_row and $arr_null
        array_push($arr_row, $arr_null);
        // dd($arr_row);

        //normalizing $arr_row
        $total = 0;
        $arr_normalized = [];
        for ($i=0; $i < count($categories); $i++) {
            $arr_temp = [];
            if($type[$i]->type == 0){
                $total = 0;
                for ($j=0; $j < count($arr_row); $j++) {
                    array_push($arr_temp,$arr_row[$j][$i]);
                }
                for ($x=0; $x < count($arr_temp); $x++) {
                    $total += 1/$arr_temp[$x];
                }
                // dd($total);
                $temp_normalized = [];
                for ($x=0; $x < count($arr_temp); $x++) {
                    $normalized = (1/$arr_row[$x][$i])/$total;
                    array_push($temp_normalized, $normalized);
                }
                array_push($arr_normalized, $temp_normalized);
                unset($temp_normalized);
            }
            if($type[$i]->type == 1){
                $total = 0;
                for ($j=0; $j < count($arr_row); $j++) {
                    // dd($arr_row);
                    array_push($arr_temp,$arr_row[$j][$i]);
                }
                for ($x=0; $x < count($arr_temp); $x++) {
                    $total += $arr_temp[$x];
                }
                // dd($arr_temp);
                $temp_normalized = [];
                for ($x=0; $x < count($arr_temp); $x++) {
                    $normalized = $arr_row[$x][$i]/$total;
                    array_push($temp_normalized, $normalized);
                }
                array_push($arr_normalized, $temp_normalized);
                unset($temp_normalized);
                // dd($arr_normalized);
            }
            unset($arr_temp);
        }
        // dd($arr_normalized);

        //make arr_normalized like arr_row structure
        $structured = [];
        for ($i=0; $i < count($arr_row); $i++) {
            $temp_normalized = [];
            for ($j=0; $j < count($arr_row[$i]); $j++) {
                array_push($temp_normalized, $arr_normalized[$j][$i]);
            }
            array_push($structured, $temp_normalized);
            unset($temp_normalized);
        }
        // dd($structured);

        //make an array that normalized and weighted. The weight is from AHP table depends on decision_maker
        $weight = Ahp::where('decision_maker_id', $id)->get();
        $arr_normalize_weighted = [];
        for ($i=0; $i < count($structured); $i++) {
            $temp_weighted = [];
            for ($j=0; $j < count($structured[$i]); $j++) {
                $weighted = $structured[$i][$j]*$weight[$j]->weight;
                array_push($temp_weighted, $weighted);
            }
            array_push($arr_normalize_weighted, $temp_weighted);
            unset($temp_weighted);
        }
        // dd($arr_normalize_weighted);

        //calculate optimum value of $arr_normalize_weighted for each school
        $optimum = [];
        for ($i=0; $i < count($arr_normalize_weighted); $i++) {
            $total = 0;
            for ($j=0; $j < count($arr_normalize_weighted[$i]); $j++) {
                $total += $arr_normalize_weighted[$i][$j];
            }
            array_push($optimum, $total);
        }
        // dd($optimum);
        $school_array = [];
        for ($i=0; $i < count( $schools); $i++) {
            $temp_array = array("id" => $schools[$i]->id, "value" => $optimum[$i]);
            array_push($school_array, $temp_array);
        }
        // dd($school_array);

        //calculate utility value of each schools
        $utility = [];
        for ($i=0; $i < count($school_array); $i++) {
            $temp_utility = $school_array[$i]["value"] / end($optimum);
            array_push($utility, $temp_utility);
        }
        // dd($utility);
        $school_utility = [];
        for ($i=0; $i < count( $schools); $i++) {
            $temp_array = array("id" => $schools[$i]->id, "value" => $utility[$i]);
            array_push($school_utility, $temp_array);
        }

        $value = [];
        for ($i=0; $i < count($school_utility); $i++) {
            array_push($value, $school_utility[$i]["value"]);
            if($i > 0){
                rsort($value);
            }
        }
        // dd($value);

        $ranked_school = [];
        for ($i=0; $i < count($value); $i++) {
            for ($j=0; $j < count($school_utility); $j++) {
                if(in_array($value[$i], $school_utility[$j])){
                    array_push($ranked_school, array("id" => $school_utility[$j]["id"], "value" => $school_utility[$j]["value"]));
                }
            }
        }
        // dd($ranked_school);
        for ($i=0; $i < count($ranked_school); $i++) {
            $calculate = new Calculate;
            $calculate->decision_maker_id = $id;
            $calculate->school_id = $ranked_school[$i]["id"];
            $calculate->rank = $i+1;
            $calculate->score = $ranked_school[$i]["value"];
            $calculate->save();
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
