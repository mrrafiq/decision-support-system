<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\SchoolSession;
use App\Models\DecisionSession;

class SchoolSessionController extends Controller
{
    public function create($id) {
        $schools = School::get();
        $session = DecisionSession::where('id', $id)->first();
        return view('school-session.create', [
            'title' => 'Sessions',
            'session' => $session,
            'schools' => $schools
        ]);
    }

    public function store(Request $request, $id){
        $data = [];
        foreach ($request->all() as $key => $value) {
           $data [] = $value;
        }

        if(count($data) < 3){
            return redirect()->route('create-school-session', ['id' => $id])->with('error', 'Sekolah yang dipilih harus lebih dari satu!');
        }
        // dd($data);
        for ($i=1; $i <= count($data)-1; $i++) {
            $input = new SchoolSession;
            $input->session_id = $id;
            $input->school_id = $data[$i];
            $input->save();
        }
        return redirect()->route('show-decision-session', ['id' => $id]);
    }

    public function edit($id){
        $school_session = SchoolSession::where('session_id', $id)->get();
        $schools = School::get();
        $data = [];
        foreach ($school_session as $key) {
            array_push($data, $key->school_id);
        }

        return view('school-session.edit',[
            'title' => 'Sessions',
            'data' => $data,
            'session' => $school_session,
            'schools' => $schools
        ]);
    }

    public function update(Request $request, $id){
        $schools = School::get();
        $data = [];
        foreach ($request->all() as $key => $value) {
           $data [] = $value;
        }

        if(count($data) < 3){
            return redirect()->route('edit-school-session', ['id' => $id])->with('error', 'Sekolah yang dipilih harus lebih dari satu!');
        }

        for ($i=0; $i < count($schools); $i++) {
            if (in_array($schools[$i]->id, $data)) {
                $school_session = SchoolSession::where('session_id', $id)
                                    ->where('school_id', $schools[$i]->id)
                                    ->first();
                if($school_session == null){
                    $input = new SchoolSession;
                    $input->session_id = $id;
                    $input->school_id = $schools[$i]->id;
                    $input->save();
                }
            }else{
                $school_session = SchoolSession::where('session_id', $id)
                                    ->where('school_id', $schools[$i]->id)
                                    ->first();
                if($school_session != null){
                    $school_session->delete();
                }
            }
        }
        return redirect()->route('show-decision-session', ['id' => $id]);
    }
}
