<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DecisionMaker;
use App\Models\UserCategories;
use App\Models\Scale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Ahp;

class AhpController extends Controller
{
    public function index($id)
    {
        $decision_maker = DecisionMaker::where('id', $id)->first();
        $user_categories = UserCategories::with(['category'])->where('decision_maker_id', $decision_maker->id)->get();
        $ahp = Ahp::where('decision_maker_id', $id)->where('session_id', $decision_maker->session_id)->get();
        $scale = Scale::get();
        // dd($user_categories);

        // $error = DB::table('temp_weighting')->where('decision_maker_id', '=', $id)->where('session_id', '=', $decision_maker->session_id)->get();

        if(count($ahp) != null){
            return redirect('/calculate');
        }
        // dd($decision_maker[1]->id);
        return view('calculate.weighting',[
            'title' => 'Calculate',
            'decision_maker' => $decision_maker,
            'user_categories' => $user_categories,
            'scale' => $scale,
            // 'error' => $error
        ]);
    }

    public function calculate(Request $request, $id)
    {
        $data = $request->all();
        $items = [];
        foreach ($data as $key => $value) {
            $items[] = $value;
        }
        $decision_maker = DecisionMaker::where('user_id', Auth::user()->id)->first();
        $user_categories = UserCategories::where('decision_maker_id', $decision_maker->id)->get();
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

        // dd(array_keys($data));

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

        // checking the error input on categories
        $arr_temp = [];
        for ($i=0; $i < count($values); $i++) {
            $temp =[];
            $artemp = [];
            for ($j=0; $j < count($values); $j++) {
                array_push($temp, $values[$j][$i]);
            }
            arsort($temp);
            foreach ($temp as $key => $value) {
                array_push($artemp, $key);
            }
            array_push($arr_temp, $artemp);
        }

        $result = 0;
        $error_categories = [];
        for ($i=0; $i < count($values); $i++) {
            if ($i != (count($values)-1)) {
                $result = array_diff_assoc($arr_temp[$i], $arr_temp[$i+1]);
            }
            if (count($result) != 0) {
                array_push($error_categories, $i);
            }
        }
        // dd($error_categories);

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

        //find weight of each category
        $weight = [];
        for ($i=0; $i < count($values); $i++) {
            $temp = 0;
            for ($j=0; $j < count($values); $j++) {
                $temp += $normalized[$i][$j];
            }
            $temp = $temp/count($values);
            array_push($weight, $temp);
            unset($temp);
        }

        // verify that the calculation is in range off error tolerance
        // (CR <= 0.1) ? true : false

        //Make an array contains $values[$i][$j] * $weight[$i]
        $arr_lmax = [];
        for ($i=0; $i < count($values); $i++) {
            $temp = [];
            for ($j=0; $j < count($values); $j++) {
                $temp [] = $values[$j][$i] * $weight[$i];
            }
            array_push($arr_lmax, $temp);
            unset($temp);
        }

        //find lmax for each category
        $lmax = [];
        for ($i=0; $i < count($arr_lmax); $i++) {
            $temp = 0;
            for ($j=0; $j < count($arr_lmax); $j++) {
                $temp += $arr_lmax[$j][$i];
            }
            array_push($lmax, $temp);
            unset($temp);
        }

        $lmax_weighted =[];
        for ($i=0; $i < count($lmax); $i++) {
            $lmax_weighted [] = $lmax[$i] / $weight[$i];
        }

        // calculating for CI
        $lmax_total = 0;
        for ($i=0; $i < count($values); $i++) {
            $lmax_total += $lmax_weighted[$i];
        }

        $lmax = $lmax_total/count($values);

        $ci = ($lmax - count($values)) / (count($values) - 1);

        $ir = [0, 0, 5.8, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49, 1.51, 1.48, 1.56, 1.57, 1.59];

        $cr = $ci/$ir[count($values)-1];

        // conditioning if CR <= 0.1
        if ($cr <= 0.1) {
            for ($i=0; $i < count($values); $i++) {
                $ahp = new Ahp;
                $ahp->decision_maker_id = $id;
                $ahp->session_id = $decision_maker->session_id;
                $ahp->category_id = $user_categories[$i]->category_id;
                $ahp->weight = $weight[$i];
                $ahp->save();
            }
            return redirect('/calculate');
        }
        else{
            //send the input into db
            //table = 'temp_weighting'
            // $key_array = array_keys($data);
            // $collection = [];
            // for ($i=0; $i < count($key_array); $i++) {
            //     $collection [] = $key_array[$i];
            // }
            // // dd($collection);
            // DB::table('temp_weighting')->truncate();
            // for ($i=1; $i < count($key_array); $i++) {
            //     DB::table('temp_weighting')->insert(
            //         [
            //             'decision_maker_id' => $id,
            //             'session_id' => $decision_maker->session_id,
            //             'area' => $collection[$i],
            //             'value' => $items[$i]
            //         ]
            //     );
            // }

            // return redirect()->back()->withErrors('Kriteria perhitungan yang salah: ');
            // return back()->with('error', 'Data yang anda inputkan tidak konsisten. Harap lakukan input dengan penuh pertimbangan! Nilai CR = '.number_format($cr,2));
            // echo '<script>alert("Input anda tidak valid!");</script>';
            // return back()->withInput();
            echo '<script type="text/javascript">alert("review your answer"); history.back()</script>';
            
        }
    }
}
