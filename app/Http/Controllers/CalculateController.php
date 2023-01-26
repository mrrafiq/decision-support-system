<?php

namespace App\Http\Controllers;

use App\Models\Calculate;
use App\Models\DecisionMaker;
use App\Models\DecisionSession;
use App\Models\SchoolSession;
use App\Models\UserCategories;
use App\Models\Ahp;
use App\Models\Aras;
use App\Models\Borda;
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
        $this->borda(3);
        $decision_maker = DecisionMaker::where('user_id', Auth::user()->id)->first();
        $check = null;
        $calculate = null;
        $ahp = null;
        $weight = null;
        if($decision_maker != null){
            $check = DecisionMaker::where('session_id', $decision_maker->session_id)->get();
            $calculate = Calculate::with('school')->where('decision_maker_id', $decision_maker->id)->where('session_id', $decision_maker->session_id)->get();
            $ahp = Ahp::with('category')->where('decision_maker_id', $decision_maker->id)->where('session_id', $decision_maker->session_id)->get();
            foreach($check as $key){
                $weight += $key->weight;
            }
        }else{
            return view('calculate.index', [
                'title' => 'Calculate',
                'decision_maker' => $decision_maker,
                'message' => 'Silahkan hubungi administrator untuk pengaturan sesi anda!'
            ]);
        }
        $school = SchoolSession::where('session_id', $decision_maker->session_id)->first();

        // check if session weight is = 1
        if($weight < 1){
            return view('calculate.index', [
                'title' => 'Calculate',
                'decision_maker' => $decision_maker,
                'dm_total' => $check,
                'school' => $school,
                'weight' => $weight,
                'message' => 'Silahkan hubungi administrator untuk pengaturan bobot pada sesi anda!'
            ]);
        }

        //check if the user is administrator
        if ($check == null) {
            return view('calculate.index', [
                'title' => 'Calculate',
            ]);
        }

        //check if the session has more than 1 decicion maker
        if (count($check) <= 1) {
            return view('calculate.index', [
                'title' => 'Calculate',
                'dm_total' => $check,
                'decision_maker' => $decision_maker,
                'weight' => $weight,
                'ahp' => $ahp,
                'school' => $school,
                'aras' => $calculate
            ]);
        }

        if (count($calculate) != 0) {
            return view('calculate.index', [
                'title' => 'Calculate',
                'dm_total' => $check,
                'decision_maker' => $decision_maker,
                'weight' => $weight,
                'ahp' => $ahp,
                'aras' => $calculate
            ]);
        }

        if (count($ahp) == 0) {
            return view('calculate.index', [
                'title' => 'Calculate',
                'dm_total' => $check,
                'weight' => $weight,
                'ahp' => $ahp,
                'decision_maker' => $decision_maker,
                'aras' => $calculate
            ]);
        }
        else {
            return view('calculate.index', [
                'title' => 'Calculate',
                'dm_total' => $check,
                'decision_maker' => $decision_maker,
                'weight' => $weight,
                'ahp' => $ahp,
                'school' => $school,
                'aras' => $calculate
            ]);
        }

    }

    public function result($id)
    {
        $decision_maker = DecisionMaker::where('id', $id)->first();
        $schools = SchoolSession::where('session_id', $decision_maker->session_id)->get();
        $categories = UserCategories::where('decision_maker_id',  $decision_maker->id)->get();
        $arr_categories = [];
        foreach ($categories as $key => $value) {
            $arr_categories [] = $value->category_id;
        }
        $arr_row = [];
        for ($i=0; $i < count($schools); $i++) {
            $arr_col = [];
            for ($j=0; $j < count($categories); $j++) {
                $aras = Aras::where('decision_maker_id', $decision_maker->id)
                        ->where('category_id', $categories[$j]->category_id)
                        ->where('school_id', $schools[$i]->school_id)
                        ->first();
                array_push($arr_col, $aras->value);
            }
            array_push($arr_row, $arr_col);
            unset($arr_col);
        }

        $arr_null = [];
        // calling type value of each user categories
        $type = UserCategories::join('categories', 'user_categories.category_id', '=', 'categories.id')
                    ->where('user_categories.decision_maker_id', $decision_maker->id)
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

        $school_array = [];
        for ($i=0; $i < count( $schools); $i++) {
            $temp_array = array("id" => $schools[$i]->school_id, "value" => $optimum[$i]);
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
            $temp_array = array("id" => $schools[$i]->school_id, "value" => $utility[$i]);
            array_push($school_utility, $temp_array);
        }
        $value = [];
        for ($i=0; $i < count($school_utility); $i++) {
            array_push($value, $school_utility[$i]["value"]);
            if($i > 0){
                rsort($value);
            }
        }

        $ranked_school = [];
        for ($i=0; $i < count($value); $i++) {
            for ($j=0; $j < count($school_utility); $j++) {
                if(in_array($value[$i], $school_utility[$j])){
                    array_push($ranked_school, array("id" => $school_utility[$j]["id"], "value" => $school_utility[$j]["value"]));
                }
            }
        }

        for ($i=0; $i < count($ranked_school); $i++) {
            $calculate = new Calculate;
            $calculate->decision_maker_id = $id;
            $calculate->session_id = $decision_maker->session_id;
            $calculate->school_id = $ranked_school[$i]["id"];
            $calculate->rank = $i+1;
            $calculate->score = $ranked_school[$i]["value"];
            $calculate->save();
        }

        $dm_total = DecisionMaker::where('session_id', $decision_maker->session_id)->get();
        $total_data = count($schools) * count($dm_total);
        $current = Calculate::where('session_id', $decision_maker->session_id)->get();
        if (count($current) == $total_data) {
            $this->borda($decision_maker->session_id);
        }
    }


    public function borda($id){
        $dm = DecisionMaker::where('session_id', $id)->get();
        $decision_maker = [];
        foreach ($dm as $key => $value) {
            $decision_maker [] = $value->id;
        }

        $school = SchoolSession::where('session_id', $id)->get();

        // the $times is for help calculate weight * times
        $times =[];
        for ($i=count($school); $i > 0; $i--) {
            $times [] = $i;
        }

        $rank = [];
        for ($i=0; $i < count($decision_maker); $i++) {

            $temp = [];

            for ($j=0; $j < count($school); $j++) {
                $data = Calculate::where('decision_maker_id', $decision_maker[$i])->where('school_id', $school[$j]->school_id)->first();
                // dd($data);
                $score = 0;
                for ($k=0; $k < count($school); $k++) {
                    if ($data->rank == $k+1) {
                        $score = $dm[$i]->weight * $times[$k];
                    }
                }
                array_push($temp, ['rank'=> $data->rank, 'school_id' => $data->school_id,'score' => $score]);
            }
            array_push($rank, $temp);
            unset($temp);
        }
        //calculate the total of each school_id in $rank array. The greatest score is the first choice, same as next
        $total =[];
        for ($i=0; $i < count($school); $i++) {
            $temp_total = 0;
            for ($j=0; $j < count($decision_maker); $j++) {
                $temp_total += $rank[$j][$i]['score'];
            }

            array_push($total, ['school_id' => $school[$i]->school_id, 'total' => $temp_total]);
        }
        // dd($total);

        $final = [];
        $temp =[];
        for ($i=0; $i < count($total); $i++) {
            $temp [] = $total[$i]['total'];
        }
        for ($i=0; $i < count($total); $i++) {
            $score = max($temp);
            $school_id = 0;
            for ($j=0; $j < count($total); $j++) {
                $find = array_search($score, $total[$j]);
                if ($find == true) {
                    $school_id = $total[$j]['school_id'];
                }
            }
            $final [] = ['rank' => $i+1, 'school_id' => $school_id,'score' => $score];
            if (($key = array_search($score, $temp)) !== false) {
                unset($temp[$key]);
            }
        }

        for ($i=0; $i < count($final); $i++) {
            $borda = new Borda;
            $borda->session_id = $id;
            $borda->school_id = $final[$i]['school_id'];
            $borda->score = $final[$i]['score'];
            $borda->rank = $final[$i]['rank'];
            $borda->save();
        }
    }
}
