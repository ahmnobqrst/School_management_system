<?php

namespace App\Http\Controllers\parents;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Student;
use App\Traits\ZoomTraitIntegration;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    use ZoomTraitIntegration;

    public function get_all_students()
    {
        $students = $this->get_childerns_data();
        return view('Dashboard.parents.childerns.childerns', compact('students'));
    }

    public function show($studentId)
    {
        $student = $this->get_childern_data($studentId);
        if($student->parent_id == auth()->user()->id)
        {
            return view('Dashboard.parents.childerns.all_data_of_childern', compact('student'));
        }
        else
        {
           toastr()->error(__('Students_trans.sorry_cant_access'));
           return redirect()->route('get.all.childern');
        }
    }

    public function get_all_student_quizzes()
    {
        $students = $this->get_childerns_data();
        $classroomIds = $students->pluck('classroom_id')->unique();
        $sectionIds   = $students->pluck('section_id')->unique();

        $quizzes = Quiz::whereIn('classroom_id', $classroomIds)
            ->whereIn('section_id', $sectionIds)->paginate(10);

        return view('Dashboard.parents.childerns.exams',compact('quizzes','students'));
    }
}
