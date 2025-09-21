<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Interface\TeacherRepositoryInterface;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Classroom;
use App\Models\Attendence;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TeacherController extends Controller
{

    protected $Teacher;
    public function __construct(TeacherRepositoryInterface $Teacher)
    {
        $this->Teacher = $Teacher;
    }

    public function index()
    {
        $teachers = $this->Teacher->getTeachersData();
        return view('Dashboard.teacher.index', compact('teachers'));
    }

    public function create()
    {
        $data['specialists'] = $this->Teacher->getSpecializations();
        $data['genders']     = $this->Teacher->getGenders();
        $data['nationals']   = $this->Teacher->getNationality();
        $data['bloods']      = $this->Teacher->getBloodType();
        return view('Dashboard.teacher.create', $data);
    }

    public function store(TeacherRequest $request)
    {
        return $this->Teacher->StoreTeachers($request);
    }

    public function show($id)
    {
        $teacher = Teacher::findOrFail($id);

        return view('Dashboard.teacher.All_data_of_teacher', compact('teacher'));
    }

    public function edit($id)
    {
        $data['specialists'] = $this->Teacher->getSpecializations();
        $data['genders']     = $this->Teacher->getGenders();
        $data['nationals']   = $this->Teacher->getNationality();
        $data['bloods']      = $this->Teacher->getBloodType();

        $data['teacher'] = $this->Teacher->EditTeacher($id);

        return view('Dashboard.teacher.edit', $data);
    }

    public function update(TeacherRequest $request)
    {
        return $this->Teacher->UpdateTeacher($request);
    }

    public function destroy(Request $request)
    {

        return $this->Teacher->DeleteTeacher($request);
    }
    public function getteacherstds()
    {
        $teacher         = Teacher::findOrFail(auth()->user()->id);
        $section         = $teacher->Sections()->pluck('section_id');
        $students   = Student::whereIn('section_id', $section)->get();

        return view('Data.allstudents', compact('students'));
    }
    public function getteacherclasses()
    {
        $teacher         = Teacher::findOrFail(auth()->user()->id);
        $section         = $teacher->Sections()->pluck('section_id');
        $classrooms = Classroom::whereIn('id', $section)->get();


        return view('Data.allclassrooms', compact('classrooms'));
    }
    public function getteachersections()
    {
        $teacher = Teacher::findOrFail(auth()->user()->id);
        $sectionsIds = $teacher->Sections()->pluck('section_id');
        $grades = Grade::whereHas('Sections', function ($q) use ($sectionsIds) {
            $q->whereIn('id', $sectionsIds);
        })
            ->with(['Sections' => function ($q) use ($sectionsIds) {
                $q->whereIn('id', $sectionsIds);
            }])
            ->get();

        return view('Data.allsections', compact('grades'));
    }

    public function getalldatastudent($id)
    {
        $teacher = Teacher::findOrFail(auth()->user()->id);
        $sections = $teacher->Sections()->pluck('section_id');
        $Student = Student::where('id', $id)
            ->whereIn('section_id', $sections)
            ->firstOrFail();

        return view('Data.allDatastudent', compact('Student'));
    }

    public function attendence()
    {
        $teacher = Teacher::findOrFail(auth()->user()->id);
        $sectionsIds = $teacher->Sections()->pluck('section_id');
        $grade = Grade::whereHas('Sections', function ($q) use ($sectionsIds) {
            $q->whereIn('id', $sectionsIds);
        })
            ->with(['Sections' => function ($q) use ($sectionsIds) {
                $q->whereIn('id', $sectionsIds);
            }])
            ->get();
        // $students = Student::whereIn('section_id', $sectionsIds)->get();
        return view('Data.attendence.index', compact('grade'));
    }
    public function registerattendence($sectionId)
    {
        $section = Section::findOrFail($sectionId);
        // dd(Student::where('section_id',$sectionId->id)->get());
        // $teacher = Teacher::findOrFail(auth()->user()->id);
        // $section = $teacher->Sections()->pluck('section_id');
        $students   = Student::where('section_id', $section->id)->get();
        return view('Data.attendence.attendence', compact('students', 'section'));
    }

    public function registerattendencestore(Request $request)
    {
        try {
            $attenddate = date('Y-m-d');
            foreach ($request->attendences as $studentid => $attendence) {

                if ($attendence == 'presence') {
                    $attendence_status = true;
                } else if ($attendence == 'absent') {
                    $attendence_status = false;
                }

                Attendence::updateOrCreate(['student_id' => $studentid], [
                    'student_id' => $studentid,
                    'grade_id' => $request->grade_id,
                    'classroom_id' => $request->classroom_id,
                    'section_id' => $request->section_id,
                    'teacher_id' => 1,
                    'attendence_date' => $attenddate,
                    'attendence_status' => $attendence_status
                ]);
            }
            toastr()->success(trans('Students_trans.success_attendence'));
            return redirect()->route('registerattendence.show', ['sectionId' => $request->section_id]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    //     public function updateattendencestore(Request $request, $sectionId)
    // {
    //     try {
    //         // التحقق من وجود ID
    //         if (!$request->has('id')) {
    //             return redirect()->back()->withErrors(['error' => 'Attendance ID is required']);
    //         }

    //         $attendance = Attendence::find($request->id);

    //         if (!$attendance) {
    //             return redirect()->back()->withErrors(['error' => 'Attendance record not found']);
    //         }

    //         // التحقق من وجود attendence_status في الطلب
    //         if (!$request->has('attendence_status')) {
    //             return redirect()->back()->withErrors(['error' => 'Attendance status is required']);
    //         }

    //         $attendance->update([
    //             'attendence_status' => $request->attendence_status == 1 ? true : false,
    //         ]);

    //         toastr()->success(trans('Students_trans.success'));
    //         return redirect()->back();
    //     } catch (\Exception $e) {
    //         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    //     }
    // }

    public function attendence_report() {
        $teacher = Teacher::findOrFail(auth()->user()->id);
        $sectionsIds = $teacher->Sections()->pluck('section_id');
        $grade = Grade::whereHas('Sections', function ($q) use ($sectionsIds) {
            $q->whereIn('id', $sectionsIds);
        })
            ->with(['Sections' => function ($q) use ($sectionsIds) {
                $q->whereIn('id', $sectionsIds);
            }])
            ->get();

        return view('Data.attendence.reports.attendence_report', compact('grade'));
    }
    public function get_report_attendence($sectionId) {
        $section = Section::findOrFail($sectionId);
        $students   = Student::where('section_id', $section->id)->get();

        return view('Data.attendence.reports.report', compact('students'));
        
    }

    public function get_attendence_report(Request $request)
    {
        // $from = Carbon::createFromFormat('Y-m-d', $request->from)->format('Y-m-d');
        // $to   = Carbon::createFromFormat('Y-m-d', $request->to)->format('Y-m-d');

       

    }
}
