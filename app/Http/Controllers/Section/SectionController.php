<?php

namespace App\Http\Controllers\Section;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\Section;
use App\Http\Requests\SectionRequest;

class SectionController extends Controller
{

    public function index()
    {
        $grade = Grade::with(['Sections.Teachers', 'Sections.Classes'])->get();
        $grades = Grade::all();
        $sections = Section::all();
        $teachers = Teacher::all();

        return view('dashboard.section.test', compact('grades', 'grade', 'sections', 'teachers'));
    }


    public function create()
    {
        //
    }

    public function store(SectionRequest $request)
    {
        try {
            $section = Section::where('Grade_id', $request->grade_id)
                ->where('Class_id', $request->classroom_id)
                ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(section_name, '$.ar')) = ?", [$request->section_name_ar])
                ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(section_name, '$.en')) = ?", [$request->section_name_en])
                ->first();

            if (! $section) {
                $section = Section::create([
                    'section_name' => [
                        'ar' => $request->section_name_ar,
                        'en' => $request->section_name_en,
                    ],
                    'Grade_id' => $request->grade_id,
                    'Class_id' => $request->classroom_id,
                    'status' => 1,
                ]);
            }
            if ($request->has('teacher_id')) {
                $existingTeacherIds = $section->Teachers()->pluck('teachers.id')->toArray();
                $newTeachers = array_diff($request->teacher_id, $existingTeacherIds);

                if (empty($newTeachers)) {
                    toastr()->warning(trans('section_trans.teacher_already_assigned'), '', ['timeOut' => 5000]);
                } else {
                    $section->Teachers()->attach($newTeachers);
                    toastr()->success(trans('section_trans.the section are saved'));
                }
            } else {
                toastr()->success(trans('section_trans.the section are saved'));
            }

            return redirect()->route('section.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {
        try {
            $sections = Section::findOrFail($request->id);

            $sections->section_name = ['ar' => $request->section_name_ar, 'en' => $request->section_name_en];
            $sections->Grade_id = $request->Grade_id;
            $sections->Class_id = $request->Class_id;

            if (isset($request->status) && !is_null($request->status)) {
                $sections->status = 1;
            } else {
                $sections->status = 0;
            }

            if (isset($request->teacher_id)) {
                $sections->Teachers()->sync($request->teacher_id);
            } else {
                $sections->Teachers()->sync(array());
            }

            $sections->save();

            toastr()->success(trans('section_trans.the section are updated'));
            return redirect()->route('section.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        Section::findOrFail($request->id)->delete();
        toastr()->success(trans('section_trans.Delete_section'));
        return redirect()->route('section.index');
    }


    public function getclasses($id)
    {
        $list_classes = Classroom::where("Grade_id", $id)->pluck("name", "id");
        return response()->json($list_classes);
    }
    public function getteacher($id)
    {
        $teachers = Teacher::where("grade_id", $id)->pluck("name", "id");
        return response()->json($teachers);
    }

    public function get_grade_for_teacher($gradeId)
    {
        $teachers = Teacher::where('grade_id', $gradeId)->pluck('name', 'id');
        return $teachers;
    }
}
