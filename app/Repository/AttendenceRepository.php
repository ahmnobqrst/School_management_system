<?php

namespace App\Repository;

use App\Models\Student;
use App\Interface\AttendenceRepositoryInterface;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\Attendence;
use Hash;
use DB;

class AttendenceRepository implements AttendenceRepositoryInterface
{

    public function index()
    {
        $grade = Grade::with(['Sections'])->get();
        $grades = Grade::all();
        $sections = Section::all();
        $teachers = Teacher::all();

        return view('dashboard.attendence.index', compact('grades', 'grade', 'sections', 'teachers'));
    }

    public function store($request)
    {

        $student = Student::with('attendance')->FindOrFail($request->student_id);
        try {

            foreach ($request->attendences as $studentid => $attendence) {

                if ($attendence == true) {
                    $attendence_status = 1;
                } else {
                    $attendence_status = 0;
                }

                Attendence::create([
                    'student_id' => $studentid,
                    'grade_id' => $request->grade_id,
                    'classroom_id' => $request->classroom_id,
                    'section_id' => $request->section_id,
                    'teacher_id' => 1,
                    'attendence_date' => date('Y-m-d'),
                    'attendence_status' => $attendence_status
                ]);
            }

            toastr()->success(trans('Students_trans.Attendence are stored'));
            return redirect()->route('attendence.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $students = Student::with('attendance')->where('section_id', $id)->get();
        return view('Dashboard.attendence.section', compact('students'));
    }

    public function edit($id) {}

    public function update($request) {}

    public function destroy($request) {}
}
