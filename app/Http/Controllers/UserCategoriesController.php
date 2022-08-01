<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCategories;
use App\Models\Category;
use App\Models\DecisionSession;
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

    public function create($id)
    {
        $categories = Category::get();
        $session = DecisionSession::where('id', $id)->first();
        return view('user-categories.create',[
            'title' => 'Categories',
            'session' => $session,
            'categories' => $categories
        ]);
    }

    public function store(Request $request, $id)
    {
        $data = [];
        foreach ($request->all() as $key => $value) {
           $data [] = $value;
        }
        // dd($data);
        for ($i=1; $i <= count($data)-1; $i++) {
            $input = new UserCategories;
            $input->session_id = $id;
            $input->category_id = $data[$i];
            $input->save();
        }
        return redirect('/user-categories');
    }

    public function edit($id)
    {
        $user_categories = UserCategories::where('session_id', $id)->get();
        $categories = Category::get();
        $data = [];
        foreach ($user_categories as $key) {
            array_push($data, $key->category_id);
        }

        // dd(array_search(5, $data, true));
        // dd($categories[0]->type);
        return view('user-categories.edit',[
            'title' => 'Categories',
            'data' => $data,
            'session' => $user_categories,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::get();
        $data = [];
        foreach ($request->all() as $key => $value) {
           $data [] = $value;
        }
        // dd($request->all());

        for ($i=0; $i < count($category); $i++) {
            if (in_array($category[$i]->id, $data)) {
                $user_categories = UserCategories::where('session_id', $id)
                                    ->where('category_id', $category[$i]->id)
                                    ->first();
                if($user_categories == null){
                    $input = new UserCategories;
                    $input->session_id = $id;
                    $input->category_id = $category[$i]->id;
                    $input->save();
                }
            }else{
                $user_categories = UserCategories::where('session_id', $id)
                                    ->where('category_id', $category[$i]->id)
                                    ->first();
                if($user_categories != null){
                    $user_categories->delete();
                }
            }
        }
        return redirect('/user-categories');
    }

    // public function destroy(Request $request)
    // {
    //     $data = UserCategories::where('id', $request->id)->first();
    //     $data->delete();
    //     return redirect('/user-categories');
    // }

}
