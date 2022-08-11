<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolDetail;
use App\Models\School;
use App\Models\Category;
use Symfony\Component\Finder\SplFileInfo;

class SchoolDetailController extends Controller
{
    public function show($id)
    {
        $data = SchoolDetail::with(['school', 'category'])->where('school_id', $id)->get();
        // dd($data);
        $school = School::where('id', $id)->first();
        $categories =[];
        $values =[];
        if (count($data) == 0) {
            return view('school-detail.index', [
                'message' => "Data kosong",
                'name' => null,
                'data' => $school,
                'categories' => $categories,
                'values' => $values,
                'title' => 'School'
            ]);
        }else{
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
                'title' => 'School',
                'data' => $school,
            ]);
        }
    }

    public function create($id)
    {
        $data = School::where('id', $id)->first();
        return view('school-detail.create',[
            'title' => "School",
            'data' => $data
        ]);
    }

    public function store(Request $request, $id){
        $school = School::where('id', $id)->first();
        $school_id = $school->id;
        $category = Category::all();


        for ($i=0; $i < count($category); $i++) {
            $school_detail = new SchoolDetail;
            $school_detail->school_id = $school_id;
            $school_detail->category_id = $category[$i]->id;

            if ($category[$i]->id == 1) {
                $school_detail->value = $request->deskripsi;
            }
            else if($category[$i]->id == 2){
                $school_detail->value = $request->visi;
            }
            else if($category[$i]->id == 3){
                $school_detail->value = $request->misi;
            }
            else if($category[$i]->id == 4){
                $school_detail->value = $request->kurikulum;
            }
            else if($category[$i]->id == 5){
                $school_detail->value = $request->biaya_pembangunan;
            }
            else if($category[$i]->id == 6){
                $school_detail->value = $request->biaya_perbulan;
            }
            else if($category[$i]->id == 7){
                $school_detail->value = $request->program_unggulan;
            }
            else if($category[$i]->id == 8){
                $school_detail->value = $request->fasilitas;
            }
            else if($category[$i]->id == 9){
                $school_detail->value = $request->ekstrakurikuler;
            }
            $school_detail->save();
        }

        return redirect('/school');
    }

    public function edit($id)
    {
        $data = SchoolDetail::with('school','category')->where('school_id', $id)->get();
        $name = $data[0]->school->name;
        $school = School::where('id', $id)->first();
        $values = [];

        foreach ($data as $value) {
            array_push($values, $value->value);
        }
        // dd($values);
        return view('school-detail.edit',
        [
            'values' => $values,
            'data' => $school,
            'title' => "School"
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $school = School::where('id', $id)->first();
            $school_id = $school->id;
            $category = Category::all();

            for ($i=0; $i < count($category); $i++) {
                $school_detail = SchoolDetail::where('school_id',$id)->where('category_id',$category[$i]->id)->first();
                // dd($school_detail);
                $school_detail->school_id = $school_id;
                $school_detail->category_id = $category[$i]->id;

                if ($category[$i]->id == 1) {
                    $school_detail->value = $request->deskripsi;
                }
                else if($category[$i]->id == 2){
                    $school_detail->value = $request->visi;
                }
                else if($category[$i]->id == 3){
                    $school_detail->value = $request->misi;
                }
                else if($category[$i]->id == 4){
                    $school_detail->value = $request->kurikulum;
                }
                else if($category[$i]->id == 5){
                    $school_detail->value = $request->biaya_pembangunan;
                }
                else if($category[$i]->id == 6){
                    $school_detail->value = $request->biaya_perbulan;
                }
                else if($category[$i]->id == 7){
                    $school_detail->value = $request->program_unggulan;
                }
                else if($category[$i]->id == 8){
                    $school_detail->value = $request->fasilitas;
                }
                else if($category[$i]->id == 9){
                    $school_detail->value = $request->ekstrakurikuler;
                }
                $school_detail->save();
            }
            return redirect('/school');
        } catch (\Throwable $th) {
            return dd($th);
        }


    }
}
