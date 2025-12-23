<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;

class StudentExamsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = auth()->user();
        $quizzes = Quiz::where('grade_id',$student->grade_id)->where('classroom_id',$student->classroom_id)
        ->where('section_id',$student->section_id)->get();

        return view('Data.Student.exams.index',compact('quizzes'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($quiz_id)
    {
       $student_id = auth()->user()->id;
       return view('Data.Student.exams.enter',compact('quiz_id','student_id'));
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

    public function show_exam_result($quiz_id)
    {
        dd($quiz_id);
    }
}
