<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCategories;
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
        return view('user-categories.create',[
            'title' => 'Categories'
        ]);
    }

    public function store(Request $request)
    {
        // dd($data);
        $user_id = Auth::user()->id;
        if($request->jarak){
            $categories = new UserCategories;
            $categories->user_id = $user_id;
            $categories->category_id = 1;
            $categories->save();
        }
        if ($request->visi_misi) {
            $categories = new UserCategories;
            $categories->user_id = $user_id;
            $categories->category_id = 3;
            $categories->save();
        }
        if($request->kurikulum){
            $categories = new UserCategories;
            $categories->user_id = $user_id;
            $categories->category_id = 5;
            $categories->save();
        }
        if($request->biaya_pembangunan){
            $categories = new UserCategories;
            $categories->user_id = $user_id;
            $categories->category_id = 6;
            $categories->save();
        }
        if($request->biaya_bulanan){
            $categories = new UserCategories;
            $categories->user_id = $user_id;
            $categories->category_id = 7;
            $categories->save();
        }
        if($request->program_unggulan){
            $categories = new UserCategories;
            $categories->user_id = $user_id;
            $categories->category_id = 8;
            $categories->save();
        }
        if($request->fasilitas){
            $categories = new UserCategories;
            $categories->user_id = $user_id;
            $categories->category_id = 9;
            $categories->save();
        }
        if($request->ekstrakurikuler){
            $categories = new UserCategories;
            $categories->user_id = $user_id;
            $categories->category_id = 10;
            $categories->save();
        }
        return redirect('/user-categories');
    }

    public function edit()
    {
        $user_categories = UserCategories::where('user_id', Auth::user()->id)->get();
        $data = [];
        foreach ($user_categories as $key) {
            array_push($data, $key->category_id);
        }
        // dd(array_search(5, $data, true));
        return view('user-categories.edit',[
            'title' => 'Categories',
            'data' => $data
        ]);
    }

    public function update(Request $request)
    {
        $user_id = Auth::user()->id;
        if($request->jarak){
            $categories = UserCategories::where('user_id', $user_id)->where('category_id', 1)->first();
            if($categories == null){
                $categories_new = new UserCategories;
                $categories_new->user_id = $user_id;
                $categories_new->category_id = 1;
                $categories_new->save();
            }
        }
        if ($request->visi_misi) {
            $categories = UserCategories::where('user_id', $user_id)->where('category_id', 3)->first();
            if($categories == null){
                $categories_new = new UserCategories;
                $categories_new->user_id = $user_id;
                $categories_new->category_id = 3;
                $categories_new->save();
            }
        }
        if($request->kurikulum){
            $categories = UserCategories::where('user_id', $user_id)->where('category_id', 5)->first();
            if($categories == null){
                $categories_new = new UserCategories;
                $categories_new->user_id = $user_id;
                $categories_new->category_id = 5;
                $categories_new->save();
            }
        }
        if($request->biaya_pembangunan){
            $categories = UserCategories::where('user_id', $user_id)->where('category_id', 6)->first();
            if($categories == null){
                $categories_new = new UserCategories;
                $categories_new->user_id = $user_id;
                $categories_new->category_id = 6;
                $categories_new->save();
            }
        }
        if($request->biaya_perbulan){
            $categories = UserCategories::where('user_id', $user_id)->where('category_id', 7)->first();
            if($categories == null){
                $categories_new = new UserCategories;
                $categories_new->user_id = $user_id;
                $categories_new->category_id = 7;
                $categories_new->save();
            }
        }
        if($request->program_unggulan){
            $categories = UserCategories::where('user_id', $user_id)->where('category_id', 8)->first();
            if($categories == null){
                $categories_new = new UserCategories;
                $categories_new->user_id = $user_id;
                $categories_new->category_id = 8;
                $categories_new->save();
            }
        }
        if($request->fasilitas){
            $categories = UserCategories::where('user_id', $user_id)->where('category_id', 9)->first();
            if($categories == null){
                $categories_new = new UserCategories;
                $categories_new->user_id = $user_id;
                $categories_new->category_id = 9;
                $categories_new->save();
            }
        }
        if($request->ekstrakurikuler){
            $categories = UserCategories::where('user_id', $user_id)->where('category_id', 10)->first();
            if($categories == null){
                $categories_new = new UserCategories;
                $categories_new->user_id = $user_id;
                $categories_new->category_id = 10;
                $categories_new->save();
            }
        }
        return redirect('/user-categories');
    }

    public function destroy(Request $request)
    {
        $data = UserCategories::where('id', $request->id)->first();
        $data->delete();
        return redirect('/user-categories');
    }

}
