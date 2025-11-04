<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentDashboardController extends Controller
{

    public $student;
    public function __construct()
    {
      $this->middleware(function ($request, $next) {
        $this->student = Student::findOrFail(auth()->user()->id);
        return $next($request);
    });
    }
    public function getStudentGrade()
    {
        $studentGrade = Grade::where('id',$this->student->grade_id)->firstOrFail();
        return view('Data.Student.grade', compact('studentGrade'));

    }
    public function getStudentClassroom()
    {
        $studentClassroom = Classroom::where('id',$this->student->classroom_id)->firstOrFail();
        return view('Data.Student.classroom', compact('studentClassroom'));

    }
    public function getStudentSection()
    {
        $studentSection = Section::where('id',$this->student->section_id)->firstOrFail();
        return view('Data.Student.section', compact('studentSection'));
    }
    public function getStudentteachers()
    {
        $studentSection = Section::where('id',$this->student->section_id)->firstOrFail();
        $teachers = $studentSection->Teachers;
        return view('Data.Student.teachers', compact('teachers'));
    }
    public function getStudentsubjects()
    {
        // return DB::table('student_subject')->where('student_id',$this->student->id)->get();
        $studentSubjects =  $this->student->Subjects;
        return view('Data.Student.subjects', compact('studentSubjects'));
    }
}
