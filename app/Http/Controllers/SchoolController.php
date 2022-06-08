<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;

class SchoolController extends Controller
{
    public function index()
    {
        $data = School::all();
        return view('school.index',[
            'title' => 'School'
        ], compact('data'));
    }

    public function create()
    {
        return view('school.create', ['title' => 'Create School']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:schools,name'
        ]);

        $school = new School;
        $school->name = $request->name;
        $school->save();
        return redirect('/school');
    }

    public function destroy(Request $request)
    {
        $school = School::where('id', $request->id)->first();
        $school->delete();
        return redirect('/school');
    }
}
