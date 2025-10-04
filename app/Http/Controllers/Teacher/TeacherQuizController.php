<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;

class TeacherQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teacher = Auth::guard('teacher')->user();
        $data['subjects'] = Subject::where('teacher_id',$teacher->id)->firstOrFail();
        $sectionsIds = $teacher->Sections()->pluck('section_id');
        // $data['grades'] = Grade::whereHas('Sections', function ($q) use ($sectionsIds) {
        //     $q->whereIn('id', $sectionsIds);
        // })
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
    public function store(Request $request)
    {
        //
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
    $teacher = Teacher::findOrFail(auth()->id());

    // نحاول نجيب ids للأقسام اللي المدرس بيديها
    // نتحسب للحالتين: علاقة ترجع pivot (section_id) أو ترجع موديولات Section (id)
    $sectionIds = $teacher->Sections()->pluck('section_id')->toArray();
    if (empty($sectionIds)) {
        // لو ما رجعش pivot، نحاول نجيب ids من الموديلات نفسها
        $sectionIds = $teacher->Sections()->pluck('id')->toArray();
    }

    // من الأقسام اللي المدرس بيديها ونفس المرحلة المطلوبة
    // ملاحظة: نستخدم أسماء الأعمدة كما هي في DB: Grade_id و Class_id
    $classroomIds = Section::whereIn('id', $sectionIds)
        ->where('Grade_id', $grade_id)
        ->distinct()
        ->pluck('Class_id')   // هنا ناخد ids الفصول
        ->toArray();

    // نرجع أسماء الفصول بصيغة (id => name) جاهزة للـ select
    $classrooms = Classroom::whereIn('id', $classroomIds)
        ->pluck('name', 'id');

    return response()->json($classrooms);
}

public function get_sections_for_grade($classroom_id)
{
    $teacher = Teacher::findOrFail(auth()->id());

    $sectionIds = $teacher->Sections()->pluck('section_id')->toArray();
    if (empty($sectionIds)) {
        $sectionIds = $teacher->Sections()->pluck('id')->toArray();
    }

    // هنا نرجع الأقسام التابعة للفصل المختار واللي المدرس بيديها
    $sections = Section::whereIn('id', $sectionIds)
        ->where('Class_id', $classroom_id)  // استخدام اسم العمود الصحيح
        ->pluck('section_name', 'id');

    return response()->json($sections);
}


}
