<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Attendence;
use App\Models\Liberary;
use App\Models\Online_Class;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\StudentQuizResult;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class StudentExamsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = auth()->user();
        $quizzes = Quiz::where('grade_id', $student->grade_id)->where('classroom_id', $student->classroom_id)
            ->where('section_id', $student->section_id)->get();

        return view('Data.Student.exams.index', compact('quizzes'));
    }

    public function show($quiz_id)
    {
        $student_id = auth()->user()->id;
        return view('Data.Student.exams.enter', compact('quiz_id', 'student_id'));
    }

    public function show_exam_result($quiz_id)
    {
        $questions = Question::where('quiz_id', $quiz_id)->get();
        $totalScore = StudentQuizResult::where('quiz_id', $quiz_id)->where('student_id', auth()->user()->id)->first();
        return view('Data.student.exams.exam_result_report', compact('questions', 'totalScore'));
    }

    public function student_appearnce(Request $request)
    {

        $userId = auth()->id();
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);
        $selectedDate = Carbon::createFromDate($year, $month, 1);
        $attendanceRecords = Attendence::where('student_id', $userId)
            ->whereYear('attendence_date', $year)
            ->whereMonth('attendence_date', $month)
            ->orderBy('attendence_date', 'desc')
            ->paginate(10);

        $availableMonths = [];
        $startDate = Carbon::create(2026, 1, 1);
        $endDate = Carbon::create(2026, 12, 31);

        $current = $startDate->copy();
        while ($current->lte($endDate)) {
            $availableMonths[] = [
                'month' => $current->month,
                'year' => $current->year,
                'label' => $current->format('Y-m')
            ];
            $current->addMonth();
        }

        $totalAppearneceInMonth = Attendence::where('student_id', $userId)
            ->whereYear('attendence_date', $year)
            ->whereMonth('attendence_date', $month)
            ->where('attendence_status', 1)
            ->count();

        $totalAbsentInMonth = Attendence::where('student_id', $userId)
            ->whereYear('attendence_date', $year)
            ->whereMonth('attendence_date', $month)
            ->where('attendence_status', 0)
            ->count();


        return view('Data.Student.attendence.report_attendence', compact(
            'attendanceRecords',
            'selectedDate',
            'availableMonths',
            'month',
            'year',
            'totalAppearneceInMonth',
            'totalAbsentInMonth'
        ));
    }

    public function student_leacture(Request $request)
    {
        $user = auth()->user();
        $month = $request->input('month', now()->month);
        $year  = $request->input('year', now()->year);

        $leactures = Online_Class::where('classroom_id', $user->classroom->id)
            ->where('section_id', $user->Section->id)
            ->whereYear('start_at', $year)
            ->whereMonth('start_at', $month)
            ->orderBy('start_at', 'desc')
            ->paginate(8);

        $availableMonths = [];
        $startDate = Carbon::create(2026, 1, 1);
        $endDate   = Carbon::create(2026, 12, 31);

        $current = $startDate->copy();
        while ($current->lte($endDate)) {
            $availableMonths[] = [
                'month' => $current->month,
                'year'  => $current->year,
                'label' => $current->format('Y-m'),
            ];
            $current->addMonth();
        }

        return view('Data.Student.leactures.index', compact(
            'leactures',
            'availableMonths',
            'month',
            'year'
        ));
    }

    public function student_books()
    {
        $user = auth()->user();
        $liberaries = Liberary::where('classroom_id', $user->classroom->id)
            ->where('section_id', $user->Section->id)->paginate(8);

        return view('Data.Student.books.index', compact('liberaries'));
    }

    public function Download_Books($path)
    {
        $fullPath = 'public/' . $path;
        if (!Storage::exists($fullPath)) {
            abort(404, 'File not found.');
        }

        return Storage::download($fullPath);
    }
}
