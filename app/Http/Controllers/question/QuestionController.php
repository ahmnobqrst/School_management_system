<?php

namespace App\Http\Controllers\question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interface\QuestionsInterface;
use App\Models\Question;

class QuestionController extends Controller
{
    public $question;
    public function __construct(QuestionsInterface $question)
    {
        return $this->question = $question;
    }
    
    public function index()
    {
        return $this->question->index();
    }

    public function create()
    {
       return $this->question->create();
    }

    public function store(Request $request)
    {
      return $this->question->store($request);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return $this->question->edit($id);
    }

    public function update(Request $request)
    {
       return $this->question->update($request);
    }

    
    public function destroy(Request $request)
    {
        return $this->question->destroy($request);
    }
}
