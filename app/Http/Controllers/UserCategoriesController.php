<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCategories;
use App\Models\Category;
use App\Models\DecisionSession;
use App\Models\DecisionMaker;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserCategoriesController extends Controller
{
    public function index()
    {
        $session = DecisionSession::get();
        $arr = [];
        foreach ($session as $key => $value) {
            $arr [] = $value->id;
        }

        $arr_data = [];
        for ($i=0; $i < count($arr); $i++) {
            $data = UserCategories::with('category', 'session')->where('session_id', $arr[$i])->get();
            $temp = [];
            foreach ($data as $key => $value) {
                $temp [] = $value->category->name;
            }
            if(count($data) != 0){
                array_push($arr_data, ['session_id' => $data[0]->session_id,'session_name' => $data[0]->session->name, 'category_name' => $temp]);
            }else{
                array_push($arr_data, ['session_id' => $session[$i]->id,'session_name' => $session[$i]->name]);
            }
        }
        // dd($arr_data);
        return view('user-categories.index', [
            'title' => 'Categories',
            'data' => $arr_data
        ]);
    }

    public function create()
    {
        $categories = Category::get();
        $decision_maker_id = DecisionMaker::where('user_id', Auth::user()->id)->first();
        return view('user-categories.create',[
            'title' => 'Sessions',
            'decision_maker_id' => $decision_maker_id,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $data = [];
        foreach ($request->all() as $key => $value) {
           $data [] = $value;
        }

        if(count($data) < 3){
            // back to the same page
            return redirect()->route('create-categories')->with('error', 'Kriteria yang dipilih harus lebih dari satu!');
        }
        $decision_maker = DecisionMaker::where('user_id', Auth::user()->id)->first();

        for ($i=1; $i <= count($data)-1; $i++) {
            $input = new UserCategories;
            $input->decision_maker_id = $decision_maker->id;
            $input->category_id = $data[$i];
            $input->save();
        }
        return redirect()->route('dashboard');
    }

    public function edit($id)
    {
        $decision_maker_id = DecisionMaker::where('user_id', Auth::user()->id)->first();
        $user_categories = UserCategories::where('decision_maker_id', $decision_maker_id->id)->get();
        $categories = Category::get();
        $data = [];
        foreach ($user_categories as $key) {
            array_push($data, $key->category_id);
        }

        // dd(array_search(5, $data, true));
        // dd($categories[0]->type);
        return view('user-categories.edit',[
            'title' => 'Sessions',
            'data' => $data,
            'decision_maker' => $decision_maker_id,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::get();
        $decision_maker = DecisionMaker::where('user_id', Auth::user()->id)->first();
        $data = [];
        foreach ($request->all() as $key => $value) {
           $data [] = $value;
        }
        if(count($data) < 3){
            return redirect()->route('edit-categories', ['id' => $id])->with('error', 'Kriteria yang dipilih harus lebih dari satu!');
        }
        // dd($request->all());

        for ($i=0; $i < count($category); $i++) {
            if (in_array($category[$i]->id, $data)) {
                $user_categories = UserCategories::where('decision_maker_id', $id)
                                    ->where('category_id', $category[$i]->id)
                                    ->first();
                if($user_categories == null){
                    $input = new UserCategories;
                    $input->decision_maker_id = $decision_maker->id;
                    $input->category_id = $category[$i]->id;
                    $input->save();
                }
            }else{
                $user_categories = UserCategories::where('decision_maker_id', $id)
                                    ->where('category_id', $category[$i]->id)
                                    ->first();
                if($user_categories != null){
                    $user_categories->delete();
                }
            }
        }
        return redirect()->route('dashboard');
    }

    // public function destroy(Request $request)
    // {
    //     $data = UserCategories::where('id', $request->id)->first();
    //     $data->delete();
    //     return redirect('/user-categories');
    // }

}
