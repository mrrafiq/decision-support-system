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
        return view('school.create', ['title' => 'School']);
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

    public function edit($id)
    {
        $data = School::where('id', $id)->first();
        return view('school.edit',[
            'data' => $data,
            'title' => "School"
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:schools,name'
        ]);

        $school = School::findOrFail($id);
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
