<?php

namespace App\Repository;
use App\Interface\QuizzesInterface;
use App\Models\Grade;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Quiz;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class QuizzesRepository implements QuizzesInterface
{

    public function index()
    {
        $quizzes = Quiz::all();
        return view('Dashboard.quizzes.index',compact('quizzes'));
       
    }

    public function store($request)
    {
    
        $quiz = new Quiz();
        $quiz->name = ['en'=>$request->name_en,'ar'=>$request->name_ar];
        $quiz->grade_id = $request->grade_id;
        $quiz->classroom_id = $request->classroom_id;
        $quiz->section_id = $request->section_id;
        $quiz->teacher_id = $request->teacher_id;
        $quiz->subject_id = $request->subject_id;
        $quiz->save();

        return redirect()->route('quizzes.index');
        toastr()->success(trans('Student_trans.Quiz Are Stored Successfully'));

    }

    public function show($id)
    {
       
    }

    public function edit($id)
    {
       $data['quizz'] = Quiz::findOrFail($id);
       $data['grades'] = Grade::all();
       $data['teachers'] = Teacher::all();
       $data['subjects'] = Subject::all();

       return view('Dashboard.quizzes.edit',$data);

    }
    public function create()
    {
        $data['grades'] = Grade::all();
        $data['teachers'] = Teacher::all();
        $data['subjects'] = Subject::all();

        return view('Dashboard.quizzes.create',$data);
    }

    public function update($request)
    {
       $quiz = Quiz::findOrFail($request->id);
       $quiz->name = ['en'=>$request->name_en,'ar'=>$request->name_ar];
       $quiz->grade_id = $request->grade_id;
       $quiz->classroom_id = $request->classroom_id;
       $quiz->section_id = $request->section_id;
       $quiz->teacher_id = $request->teacher_id;
       $quiz->subject_id = $request->subject_id;
       $quiz->save();

       toastr()->success(trans('Students_trans.Quiz Are updated Successfully'));
       return redirect()->route('quizzes.index');

    }

    public function destroy($request)
    {
       Quiz::where('id',$request->id)->delete();
       toastr()->success(trans('Students_trans.Quiz Are deleted Successfully'));
       return redirect()->route('quizzes.index');

    }
}