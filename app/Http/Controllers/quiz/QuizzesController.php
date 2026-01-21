<?php

namespace App\Http\Controllers\quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interface\QuizzesInterface;

class QuizzesController extends Controller
{
    public $quiz;
    public function __construct(QuizzesInterface $quiz)
    {
        return $this->quiz = $quiz;
    }
    public function index()
    {
       return $this->quiz->index();
    }
    public function create()
    {
        return $this->quiz->create();
    }
    public function store(Request $request)
    {
        return $this->quiz->store($request);
    }

    
    public function show($id)
    {
        return $this->quiz->show($id);
    }

    
    public function edit($id)
    {
        return $this->quiz->edit($id);
    }

    public function update(Request $request)
    {
        return $this->quiz->update($request);
    }

    public function destroy(Request $request)
    {
       return $this->quiz->destroy($request);
    }
}
