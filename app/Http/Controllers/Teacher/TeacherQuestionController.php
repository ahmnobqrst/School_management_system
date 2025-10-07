<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TeacherQuestionRequest;
use App\Interface\TeacherQuestionRepositoryInterface;

class TeacherQuestionController extends Controller
{
    public $question;
    public function __construct(TeacherQuestionRepositoryInterface $question)
    {
        $this->question = $question;
    }
    public function index()
    {
        return $this->question->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($section)
    {
       return $this->question->create($section);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherQuestionRequest $request)
    {
        return $this->question->store($request);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
