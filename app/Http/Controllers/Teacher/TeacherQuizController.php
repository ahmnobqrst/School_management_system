<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Quiz;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Http\Requests\QuizTeacherRequest;
use App\Models\Question;
use App\Models\StudentQuizResult;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Traits\ZoomTraitIntegration;

class TeacherQuizController extends Controller
{
    use ZoomTraitIntegration;
    public function index()
    {
        $quizzes = Quiz::where('teacher_id', Auth::guard('teacher')->user()->id)->get();
        return view('Data.quizzes.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $teacher = Auth::guard('teacher')->user();
        $data['subject'] = Subject::where('teacher_id', $teacher->id)->firstOrFail();
        // if($teacher->subject)
        // {
        //     $data['subject'] = Subject::where('teacher_id',$teacher->id)->firstOrFail();
        // }
        // else
        // {
        //    toastr()->error(trans('Students_trans.subject_teacher'));
        //    return redirect()->back();
        // }
        $data['grades'] = $this->getteachergrades();

        return view('Data.quizzes.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuizTeacherRequest $request)
    {
        $quiz = Quiz::create([
            'name' => ['ar' => $request->name_ar, 'en' => $request->name_en],
            'subject_id' => $request->subject_id,
            'teacher_id' => Auth::guard('teacher')->user()->id,
            'grade_id' => $request->grad_id,
            'classroom_id' => $request->class_id,
            'section_id' => $request->sect_id,

        ]);

        toastr()->success(trans('Students_trans.success_quizz'));
        return redirect()->route('quizz.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        // $sectionsIds = auth()->guard('teacher')->user()->Sections()->pluck('section_id');
        $data['quizz'] = Quiz::where('teacher_id', auth()->guard('teacher')->user()->id)->findOrFail($id);
        $data['subject'] = Subject::where('teacher_id', auth()->guard('teacher')->user()->id)->firstOrFail();
        $data['grades'] =  $this->getteachergrades();
        return view('Data.quizzes.edit', $data);
    }

    public function update(QuizTeacherRequest $request)
    {
        $quiz = Quiz::findOrFail($request->id);
        $quiz->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
        $quiz->subject_id = $request->subject_id;
        $quiz->teacher_id = auth()->guard('teacher')->user()->id;
        $quiz->grade_id = $request->grad_id;
        $quiz->classroom_id = $request->class_id;
        $quiz->section_id = $request->sect_id;
        $quiz->save();

        toastr()->success(trans('Students_trans.Quiz Are updated Successfully'));
        return redirect()->route('quizz.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $teacher = auth()->guard('teacher')->user();
        Quiz::where('id', $request->id)->where('teacher_id', $teacher->id)->delete();
        toastr()->success(trans('Students_trans.Quiz Are deleted Successfully'));
        return redirect()->route('quizz.index');
    }

    public function get_classes_for_grade($grade_id)
    {
        $teacher = Teacher::with('Sections.Classes')->where('Grade_id', $grade_id)
            ->findOrFail(auth()->user()->id);
        $sections = $teacher->sections;
        $classrooms = $sections->pluck('Classes')->pluck('name', 'id');
        return response()->json($classrooms);
    }

    public function get_sections_for_grade($classroom_id)
    {
        $section = Section::where('Class_id', $classroom_id)->pluck('section_name', 'id');
        return response()->json($section);
    }

    public function get_student_in_quiz($quizId)
    {
        $students = StudentQuizResult::with('student')->where('quiz_id', $quizId)->get();
        return view('Dashboard.teacher.quiz.student_exam', compact('students'));
    }

    public function get_student_answers($quizId, $studentId)
    {
        $questions = Question::with(['responses' => function ($q) use ($studentId) {
            $q->where('student_id', $studentId);
        }])
            ->where('quiz_id', $quizId)
            ->get();
        
        $totalScore = StudentQuizResult::where('quiz_id',$quizId)->where('student_id',$studentId)->firstOrFail();
        return view('Dashboard.teacher.quiz.student_answers',compact('questions', 'studentId','totalScore','quizId'));
    }

    public function confirm_student_degree($quizId,$studentId)
    {
        $student_degree = StudentQuizResult::where('quiz_id',$quizId)->where('student_id',$studentId)->firstOrFail();
        $student_degree->updateOrCreate(
        [
            'quiz_id'=>$quizId,
            'student_id'=>$studentId,
        ],
        [
           'check'=>true,
        ]);

        return redirect()->back();
    }
}
