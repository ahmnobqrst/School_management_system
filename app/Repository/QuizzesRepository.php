<?php

namespace App\Repository;
use App\Interface\QuizzesInterface;
use App\Models\{Quiz,Question,Grade,Teacher,Subject};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class QuizzesRepository implements QuizzesInterface
{

    public function index()
    {
        $quizzes = Quiz::paginate(10);
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
       $questions = Question::where('quiz_id',$id)->paginate(8);
       $totalDegree = Question::where('quiz_id',$id)->sum('degree');
       return view('Dashboard.quizzes.show_questions',compact('questions','totalDegree'));
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