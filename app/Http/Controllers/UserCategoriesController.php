<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCategories;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserCategoriesController extends Controller
{
    public function index()
    {
        $data = UserCategories::with('category')->where('user_id', Auth::user()->id)->get();
        return view('user-categories.index', [
            'title' => 'Categories',
        ], compact('data'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('user-categories.create',[
            'title' => 'Categories',
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        // dd($data);
        $user_id = Auth::user()->id;
        $data = [];
        foreach ($request->all() as $key => $value) {
           $data [] = $value;
        }
        // dd($data);
        for ($i=1; $i <= count($data)-1; $i++) {
            $input = new UserCategories;
            $input->user_id = $user_id;
            $input->category_id = $data[$i];
            $input->save();
        }
        return redirect('/user-categories');
    }

    public function edit()
    {
        $user_categories = UserCategories::where('user_id', Auth::user()->id)->get();
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
            'categories' => $categories
        ]);
    }

    public function update(Request $request)
    {
        $user_id = Auth::user()->id;
        $category = Category::get();
        $data = [];
        foreach ($request->all() as $key => $value) {
           $data [] = $value;
        }
        // dd($request->all());

        for ($i=0; $i < count($category); $i++) {
            if (in_array($category[$i]->id, $data)) {
                $user_categories = UserCategories::where('user_id', $user_id)
                                    ->where('category_id', $category[$i]->id)
                                    ->first();
                if($user_categories == null){
                    $input = new UserCategories;
                    $input->user_id = $user_id;
                    $input->category_id = $category[$i]->id;
                    $input->save();
                }
            }else{
                $user_categories = UserCategories::where('user_id', $user_id)
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
