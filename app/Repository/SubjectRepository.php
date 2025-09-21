<?php

namespace App\Repository;
use App\Models\Fee;
use App\Models\Grade;
use App\Models\Teacher;
use App\Models\Subject;
use App\Interface\SubjectRepositoryInterface;
use Hash;
use DB;

class SubjectRepository implements SubjectRepositoryInterface
{

    public function index()
    {
        $subjects = Subject::all();
        return view('dashboard.subjects.index',compact('subjects'));
    }

    public function create()
    {
       $grades = Grade::all();
       $teachers = Teacher::all();

       return view('dashboard.subjects.add',compact('grades','teachers'));
    }
    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $grades = Grade::all();
        $teachers = Teacher::all();
        return view('dashboard.subjects.edit',compact('subject','grades','teachers'));
       
    }
    public function show($id)
    {
       
    }

    public function store($request)
    {
       $subject = new Subject();
       $subject->name = ['ar'=>$request->name_ar,'en'=>$request->name_en];
       $subject->grade_id = $request->grade_id;
       $subject->classroom_id = $request->classroom_id;
       $subject->teacher_id = $request->teacher_id;

       $subject->save();

       toastr()->success(trans('Students_trans.the Subject are saved'));
       return redirect()->route('subjects.index');
    }

    public function update($request)
    {
        $subject = Subject::findOrFail($request->id);
        $subject->name = ['ar'=>$request->name_ar,'en'=>$request->name_en];
        $subject->grade_id = $request->grade_id;
        $subject->classroom_id = $request->classroom_id;
        $subject->teacher_id = $request->teacher_id;
        $subject->save();

        toastr()->success(trans('Students_trans.the Subject are updated'));
        return redirect()->route('subjects.index');

    }

    public function destroy($request)
    {
        Subject::where('id',$request->id)->delete();
        toastr()->success(trans('Students_trans.the Subject are deleted'));
        return redirect()->route('subjects.index');
    }
}