<?php
namespace App\Repository;

use App\Interface\TeacherQuestionRepositoryInterface;
use App\Models\BloodType;
use App\Models\Gender;
use App\Models\National;
use App\Models\Specialist;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Teacher;
use Hash;

class TeacherQuestionRepository implements TeacherQuestionRepositoryInterface
{
    public function index()
    {
       $quiz = Quiz::where('teacher_id',auth()->guard('teacher')->user()->id)->firstOrFail();
       $questions = Question::where('quiz_id',$quiz->id)->get();
       return view('Data.question.index',compact('questions'));
    }

    public function store($request)
    {
      $question = Question::create([
         'title'=>['ar'=>$request->name_ar,'en'=>$request->name_en],
         'answer'=>['ar'=>$request->answer_ar,'en'=>$request->answer_en],
         'right_answer'=>['ar'=>$request->right_answer_ar,'en'=>$request->right_answer_en],
         'degree'=>$request->degree,
         'quiz_id'=>$request->quiz_id
      ]);

      toastr()->success(trans('Students_trans.Question_stored'));
      return redirect()->route('question.index');
    }

    public function edit($id)
    {
      $question = Question::findOrFail($id);
      $quizzes = Quiz::all();
      return view('Data.question.edit',compact('question','quizzes'));
    }
    public function create($section)
    {
        dd($section);
      $quizzes = Quiz::where('');
      return view('Data.question.create',compact('quizzes'));
    }

    public function update($request)
    {

       $question = Question::findOrFail($request->id);
       $question->title = ['ar'=>$request->name_ar,'en'=>$request->name_en];
       $question->answer = ['ar'=>$request->answer_ar,'en'=>$request->answer_en];
       $question->right_answer = ['ar'=>$request->right_answer_ar,'en'=>$request->right_answer_en];
       $question->degree = $request->degree;
       $question->quiz_id = $request->quiz_id;
       $question->save();

      toastr()->success(trans('Students_trans.Question_updated'));
      return redirect()->route('question.index');

    }

    public function destroy($request)
    {
      Question::where('id',$request->id)->delete();

      toastr()->success(trans('Students_trans.Question_deleted'));
      return redirect()->route('question.index');

    }
}
