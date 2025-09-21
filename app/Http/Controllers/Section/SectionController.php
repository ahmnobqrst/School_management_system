<?php

namespace App\Http\Controllers\Section;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\Section;
use App\Http\Requests\SectionRequest;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grade = Grade::with(['Sections'])->get();
        $grades = Grade::all();
        $sections = Section::all();
        $teachers = Teacher::all();
       
        return view('dashboard.section.test',compact('grades','grade','sections','teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionRequest $request)
    {

        try {

        $sections = new Section();
        $sections->section_name = ['ar'=> $request->section_name_ar, 'en'=>$request->section_name_en];
        $sections->Grade_id = $request->Grade_id;
        $sections->Class_id = $request->Class_id;
        $sections->status = 1;
        $sections->save();

        $sections->Teachers()->attach($request->teacher_id);

        toastr()->success(trans('section_trans.the section are saved'));
        return redirect()->route('section.index');

    }

    catch (\Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
      

    

    try {
        //$validated = $request->validated();
        $sections = Section::findOrFail($request->id);
  
        $sections->section_name = ['ar'=> $request->section_name_ar, 'en'=>$request->section_name_en];
        $sections->Grade_id = $request->Grade_id;
        $sections->Class_id = $request->Class_id;
  
        if(isset($request->status) && !is_null($request->status)) {
          $sections->status = 1;
        } else {
          $sections->status = 0;
        }

        if(isset($request->teacher_id)){
            $sections->Teachers()->sync($request->teacher_id);
        }
        else{
            $sections->Teachers()->sync(array());
        }
  
        $sections->save();

        toastr()->success(trans('section_trans.the section are updated'));
        return redirect()->route('section.index');
    }
    catch
    (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Section::findOrFail($request->id)->delete();
        toastr()->success(trans('section_trans.Delete_section'));
        return redirect()->route('section.index');
    }


    public function getclasses($id)
    {
        $list_classes = Classroom::where("Grade_id", $id)->pluck("name", "id");
        

        return $list_classes;
    }
}
