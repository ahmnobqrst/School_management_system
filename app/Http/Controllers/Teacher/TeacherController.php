<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\{TeacherRequest, ReportRequest};
use App\Interface\TeacherRepositoryInterface;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Subject;
use App\Models\Section;
use App\Models\Classroom;
use App\Models\Attendence;
use Illuminate\Http\Request;
use App\Http\Requests\TeacherQuestionRequest;
use Carbon\Carbon;
use App\Traits\ZoomTraitIntegration;

class TeacherController extends Controller
{
  use ZoomTraitIntegration;
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
        $section = $this->getSections();
        $students   = Student::whereIn('section_id', $section)->get();

        return view('Data.allstudents', compact('students'));
    }
    public function getteacherclasses()
    {
        $section = $this->getSections();
        $classrooms = Classroom::whereIn('id', $section)->get();


        return view('Data.allclassrooms', compact('classrooms'));
    }
    public function getgrade()
    {
        $grade = $this->getteachersection();
        return view('Data.grade', compact('grade'));
    }
    public function getsubject()
    {
        $teacher = Teacher::findOrFail(auth()->user()->id);
        $subject = Subject::where('teacher_id', $teacher->id)->firstOrFail();
        return view('Data.subject', compact('subject'));
    }
    public function sections()
    {
       $grades = $this->getteachersections();
       return view('Data.allsections', compact('grades'));
    }

    public function getalldatastudent($id)
    {
        $sections = $this->getSections();
        $Student = Student::where('id', $id)
            ->whereIn('section_id', $sections)
            ->firstOrFail();

        return view('Data.allDatastudent', compact('Student'));
    }

    public function attendence()
    {
        $grade = $this->getteachersections();
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

    // public function registerattendencestore(Request $request)
    // {
    //     try {
    //         $attenddate = date('Y-m-d');
    //         foreach ($request->attendences as $studentid => $attendence) {

    //             if ($attendence == 'presence') {
    //                 $attendence_status = true;
    //             } else if ($attendence == 'absent') {
    //                 $attendence_status = false;
    //             }

    //             if(!date('Y-m-d'))
    //             {
    //                 Attendence::create([
    //                 'student_id' => $studentid,
    //                 'grade_id' => $request->grade_id,
    //                 'classroom_id' => $request->classroom_id,
    //                 'section_id' => $request->section_id,
    //                 'teacher_id' => 1,
    //                 'attendence_date' => $attenddate,
    //                 'attendence_status' => $attendence_status
    //                ]);
    //             }else{
    //                 Attendence::updateOrCreate(['student_id' => $studentid], [
    //                     'student_id' => $studentid,
    //                     'grade_id' => $request->grade_id,
    //                     'classroom_id' => $request->classroom_id,
    //                     'section_id' => $request->section_id,
    //                     'teacher_id' => 1,
    //                     'attendence_date' => $attenddate,
    //                     'attendence_status' => $attendence_status
    //                 ]);
    //             }
    //         }
    //         toastr()->success(trans('Students_trans.success_attendence'));
    //         return redirect()->route('registerattendence.show', ['sectionId' => $request->section_id]);
    //     } catch (\Exception $e) {
    //         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    //     }
    // }

    public function registerattendencestore(Request $request)
    {
        try {
            $attenddate = date('Y-m-d');

            foreach ($request->attendences as $studentid => $attendence) {
                $attendence_status = $attendence === 'presence';

                Attendence::updateOrCreate(
                    [
                        'student_id'      => $studentid,
                        'attendence_date' => $attenddate,
                    ],
                    [
                        'grade_id'          => $request->grad_id,
                        'classroom_id'      => $request->class_id,
                        'section_id'        => $request->sect_id,
                        'teacher_id'        => 1,
                        'attendence_status' => $attendence_status,
                    ]
                );
            }

            toastr()->success(trans('Students_trans.success_attendence'));
            return redirect()->route('registerattendence.show', ['sectionId' => $request->sect_id]);
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

    public function attendence_report()
    {
        $grade = $this->getteachersections();

        return view('Data.attendence.reports.attendence_report', compact('grade'));
    }
    public function get_report_attendence($sectionId)
    {
        $section = Section::findOrFail($sectionId);
        $students   = Student::where('section_id', $section->id)->get();

        return view('Data.attendence.reports.report', compact('students'));
    }

    public function get_attendence_report(ReportRequest $request)
    {

        $Students = Attendence::whereBetween('attendence_date', [$request->from, $request->to])->paginate(15);
        return view('Data.attendence.reports.result_report', compact('Students'));
    }



    // this is report about sections questions to get all questions for all sections 

    public function question_section_report()
    {
        $grade = $this->getteachersections();

        return view('Data.question.question_sections', compact('grade'));
    }

    public function get_questions($sectionId)
    {

        $section = Section::find($sectionId);

        if (!$section) {
            return view('Data.question.index', ['questions' => collect()]);
        }

        $quizsection = Quiz::where('section_id', $section->id)->first();

        if (!$quizsection) {
            return view('Data.question.index', ['questions' => collect(),'sectionId'=>$sectionId]);
        }

        $questions = Question::where('quiz_id', $quizsection->id)->get();

        return view('Data.question.index', compact('questions','sectionId'));
    }

    public function create_question_for_section($sectionId)
    {
       $quizzes = Quiz::where('section_id',$sectionId)->get();
       return view('Data.question.create', compact('quizzes','sectionId'));
    }

    public function store_question_for_section(TeacherQuestionRequest $request,$sectionId)
    {
        $question = Question::create([
         'title'=>['ar'=>$request->name_ar,'en'=>$request->name_en],
         'answer'=>['ar'=>$request->answer_ar,'en'=>$request->answer_en],
         'right_answer'=>['ar'=>$request->right_answer_ar,'en'=>$request->right_answer_en],
         'degree'=>$request->degree,
         'quiz_id'=>$request->quiz_id
      ]);

      toastr()->success(trans('Students_trans.Question_stored'));
      return redirect()->route('questions',compact('sectionId'));
    }

    public function edit_question($question)
    {
       $question = Question::findOrFail($question);
    //    $quizzes = Quiz::all();
       $quizzes = $question->quizz->get();
       return view('Data.question.edit', compact('question','quizzes'));
    }
    public function update_question(TeacherQuestionRequest $request,$question)
    {
       $question = Question::findOrFail($question);
    //    dd($question->quizz->id);
        $question->title = ['ar'=>$request->name_ar,'en'=>$request->name_en];
         $question->answer = ['ar'=>$request->answer_ar,'en'=>$request->answer_en];
         $question->right_answer=['ar'=>$request->right_answer_ar,'en'=>$request->right_answer_en];
         $question->degree=$request->degree;
         $question->quiz_id=$request->quiz_id;
         $question->save();

       toastr()->success(trans('Students_trans.Question_updated'));
       return redirect()->route('question_section');
    }
    public function delete_question(Request $request,$sectionId)
    {
        // dd($sectionId);
       Question::where('id',$request->id)->delete();
       toastr()->success(trans('Students_trans.Question_deleted'));
       return redirect()->route('questions',compact('sectionId'));
    }
}
