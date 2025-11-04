<?php

namespace App\Repository;
use App\Interface\QuestionsInterface;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class QuestionRepository implements QuestionsInterface
{

    public function index()
    {
       $questions = Question::all();
       return view('Dashboard.questions.index',compact('questions'));
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
      return redirect()->route('questions.index');
    }

    public function edit($id)
    {
      $question = Question::findOrFail($id);
      $quizzes = Quiz::all();
      return view('Dashboard.questions.edit',compact('question','quizzes'));
    }
    public function create()
    {
      $quizzes = Quiz::all();
      return view('Dashboard.questions.create',compact('quizzes'));
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
      return redirect()->route('questions.index');

    }

    public function destroy($request)
    {
      Question::where('id',$request->id)->delete();

      toastr()->success(trans('Students_trans.Question_deleted'));
      return redirect()->route('questions.index');

    }
}