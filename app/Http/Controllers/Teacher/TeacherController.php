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
use Illuminate\Support\Facades\DB;

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
        $data['grades'] = $this->Teacher->getGrades();
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
        $data['grades']      = $this->Teacher->getGrades();

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
        // $section = $this->getSections();
        // if($section->students)
        // {
        //     $students   = Student::whereIn('section_id', $section)->get();
        // }
        // else
        // {
        //     $students = ['students' => collect()];
        // }

        // return view('Data.allstudents', compact('students'));

        $section = $this->getSections();
        $sectionIds = $section->pluck('id')->toArray();
        $students = Student::whereIn('section_id', $sectionIds)->get();
        return view('Data.allstudents', compact('students'));
    }
    public function getteacherclasses()
    {
        $classrooms = $this->getSections()->pluck('Classes')->flatten()->unique('id');
        return view('Data.allclassrooms', compact('classrooms'));
    }
    public function getgrade()
    {
        $grade = Teacher::with('grade')->findOrFail(auth()->user()->id);
        return view('Data.grade', compact('grade'));
    }
    public function getsubject()
    {
        $teacher = Teacher::findOrFail(auth()->user()->id);
        $subject = Subject::where('teacher_id', $teacher->id)->first();
        return view('Data.subject', compact('subject'));
    }
    // public function sections()
    // {
    // //    $grades = $this->getteachersections();
    //     $grades = DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->get();
    //     dd($grades);
    //    return view('Data.allsections', compact('grades'));
    // }

    public function getalldatastudent($id)
    {
        $teacher = Teacher::with('Sections.Classes')
        ->findOrFail(auth()->user()->id);
        $sections = $teacher->sections()->pluck('section_id');
        $Student = Student::where('id', $id)
            ->whereIn('section_id', $sections)
            ->firstOrFail();

        return view('Data.allDatastudent', compact('Student'));
    }

    public function attendence()
    {
        $teacher = $this->getteachergrade();
        return view('Data.attendence.index', compact('teacher'));
    }
    public function registerattendence($sectionId)
    {
        $section = Section::findOrFail($sectionId);
        $students   = Student::where('section_id', $section->id)->get();
        return view('Data.attendence.attendence', compact('students', 'section'));
    }


    public function registerattendencestore(Request $request,$sectionId)
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
                        'grade_id'          => $request->grade_id,
                        'classroom_id'      => $request->classroom_id,
                        'section_id'        => $sectionId,
                        'teacher_id'        => auth()->user()->id,
                        'attendence_status' => $attendence_status,
                    ]
                );
            }

            toastr()->success(trans('Students_trans.success_attendence'));
            return redirect()->route('registerattendence.show', ['sectionId' => $sectionId]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function attendence_report()
    {
        $teacher = $this->getteachergrade();
        return view('Data.attendence.reports.attendence_report', compact('teacher'));
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
        $teacher = $this->getteachergrade();

        return view('Data.question.question_sections', compact('teacher'));
    }

    public function get_questions($sectionId)
    {

        $section = Section::find($sectionId);

        if (!$section) {
            return view('Data.question.index', ['questions' => collect()]);
        }

        $quizsection = Quiz::where('section_id', $section->id)->first();

        if (!$quizsection) {
            return view('Data.question.index', ['questions' => collect(), 'sectionId' => $sectionId]);
        }

        $questions = Question::where('quiz_id', $quizsection->id)->get();

        return view('Data.question.index', compact('questions', 'sectionId'));
    }

    public function create_question_for_section($sectionId)
    {
        $quizzes = Quiz::where('section_id', $sectionId)->get();
        return view('Data.question.create', compact('quizzes', 'sectionId'));
    }

    public function store_question_for_section(TeacherQuestionRequest $request, $sectionId)
    {
        $question = Question::create([
            'title' => ['ar' => $request->name_ar, 'en' => $request->name_en],
            'answer' => ['ar' => $request->answer_ar, 'en' => $request->answer_en],
            'right_answer' => ['ar' => $request->right_answer_ar, 'en' => $request->right_answer_en],
            'degree' => $request->degree,
            'quiz_id' => $request->quiz_id
        ]);

        toastr()->success(trans('Students_trans.Question_stored'));
        return redirect()->route('questions', compact('sectionId'));
    }

    public function edit_question($question)
    {
        $question = Question::findOrFail($question);
        //    $quizzes = Quiz::all();
        $quizzes = $question->quizz->get();
        return view('Data.question.edit', compact('question', 'quizzes'));
    }
    public function update_question(TeacherQuestionRequest $request, $question)
    {
        $question = Question::findOrFail($question);
        //    dd($question->quizz->id);
        $question->title = ['ar' => $request->name_ar, 'en' => $request->name_en];
        $question->answer = ['ar' => $request->answer_ar, 'en' => $request->answer_en];
        $question->right_answer = ['ar' => $request->right_answer_ar, 'en' => $request->right_answer_en];
        $question->degree = $request->degree;
        $question->quiz_id = $request->quiz_id;
        $question->save();

        toastr()->success(trans('Students_trans.Question_updated'));
        return redirect()->route('question_section');
    }
    public function delete_question(Request $request, $sectionId)
    {
        // dd($sectionId);
        Question::where('id', $request->id)->delete();
        toastr()->success(trans('Students_trans.Question_deleted'));
        return redirect()->route('questions', compact('sectionId'));
    }
}
