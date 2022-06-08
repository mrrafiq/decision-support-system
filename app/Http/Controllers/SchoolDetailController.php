<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolDetail;

class SchoolDetailController extends Controller
{
    public function show($id)
    {
        $data = SchoolDetail::with(['school', 'category'])->where('school_id', $id)->get();

        $categories =[];
        $values =[];
        $name = $data[0]->school->name;
        foreach ($data as $value) {
            array_push($categories, $value->category->name);
            array_push($values, $value->value);
        }
        // dd($categories);
        // dd($values);
        // dd($name);
        return view('school-detail.index',[
            'categories' => $categories,
            'values' => $values,
            'name' => $name,
            'title' => $name
        ]);
    }
}
