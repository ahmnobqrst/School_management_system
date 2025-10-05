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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TeacherQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = Quiz::where('teacher_id',Auth::guard('teacher')->user()->id)->get();
        return view('Data.quizzes.index',compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teacher = Auth::guard('teacher')->user();
        $data['subject'] = Subject::where('teacher_id',$teacher->id)->firstOrFail();
        $sectionsIds = $teacher->Sections()->pluck('section_id');
        $data['grades'] = Grade::whereHas('Sections', function ($q) use ($sectionsIds) {
            $q->whereIn('id', $sectionsIds);
        })
            ->with(['Sections' => function ($q) use ($sectionsIds) {
                $q->whereIn('id', $sectionsIds);
            }])
            ->get();
        

        return view('Data.quizzes.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuizTeacherRequest $request)
    {
        $quiz = Quiz::create([
           'name'=>['ar'=>$request->name_ar,'en'=>$request->name_en],
           'subject_id'=>$request->subject_id,
           'teacher_id'=>Auth::guard('teacher')->user()->id,
           'grade_id'=>$request->grade_id,
           'classroom_id'=>$request->classroom_id,
           'section_id'=>$request->section_id,
           
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
public function get_classes_for_grade($grade_id)
{
    $teacher = Auth::guard('teacher')->user();
    $sectionsIds = $teacher->Sections()->pluck('section_id');

    $classes = Section::whereIn('id',$sectionsIds)->where('Grade_id',$grade_id)->pluck('Class_id');
    // $class = $classes->Classes->name;
    $classrooms = Classroom::whereIn('id', $classes)
        ->pluck('name','id');

    return response()->json($classrooms);
}

    // $teacher = Auth::guard('teacher')->user();
    // $sectionIds = $teacher->Sections()->pluck('section_id')->toArray();
    // $classroomIds = Section::whereIn('id', $sectionIds)
    //     ->where('Grade_id', $grade_id)
    //     ->pluck('Class_id')
    //     ->unique()
    //     ->toArray();
    // $classrooms = Classroom::whereIn('id', $classroomIds)
    //     ->pluck('name', 'id');
    // return response()->json($classrooms);
   
    
// }

public function get_sections_for_grade($classroom_id)
{
    $section = Section::where('Class_id',$classroom_id)->pluck('section_name','id');
    return response()->json($section);

}
}
