<?php

namespace App\Repository;

use App\Models\Student;
use App\Interface\AttendenceRepositoryInterface;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\Attendence;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AttendanceReportExport;
use App\Http\Requests\ReportRequest;

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

    public function show(ReportRequest $request, $id)
    {
        $name = (string) ($request->get('name') ?? '');

        $year  = (int) $request->get('year', now()->year);
        $month = (int) $request->get('month', now()->month);

        $defaultFrom = Carbon::createFromDate($year, $month, 1)->startOfDay();
        $defaultTo   = Carbon::createFromDate($year, $month, 1)->endOfMonth()->endOfDay();

        $from = $request->filled('from') ? Carbon::parse($request->from)->startOfDay() : $defaultFrom;
        $to   = $request->filled('to')   ? Carbon::parse($request->to)->endOfDay()     : $defaultTo;

        $days = $this->makeDaysRange($from, $to);

        $months = collect(range(1, 12))->map(function ($m) use ($year) {
            return [
                'number' => $m,
                'name'   => Carbon::createFromDate($year, $m, 1)->translatedFormat('F'),
            ];
        });

        $students = Student::with([
            'Grade',
            'Section',
            'attendance' => function ($q) use ($from, $to, $id) {
                $q->where('section_id', $id)
                    ->whereBetween('attendence_date', [$from->toDateString(), $to->toDateString()]);
            }
        ])
            ->where('section_id', $id)
            ->when($name, function ($q) use ($name) {
                $q->where('name', 'like', "%{$name}%");
            })
            ->orderBy('name')
            ->get();

        $attendanceMap = [];
        foreach ($students as $student) {
            foreach ($student->attendance as $att) {
                $date = is_object($att->attendence_date)
                    ? $att->attendence_date->format('Y-m-d')
                    : \Carbon\Carbon::parse($att->attendence_date)->format('Y-m-d');

                $attendanceMap[$student->id][$date] = (int) $att->attendence_status;
            }
        }


        if ($request->get('export') === 'excel') {
            $fileName = "attendance_section_{$id}_{$from->format('Ymd')}_{$to->format('Ymd')}.xlsx";

            return Excel::download(
                new AttendanceReportExport($students, $days, $from->toDateString(), $to->toDateString(), (int)$id, (string)($name ?? '')),
                $fileName
            );
        }


        if ($request->get('export') === 'pdf') {
            $fileName = "attendance_section_{$id}_{$from->format('Ymd')}_{$to->format('Ymd')}.pdf";

            $pdf = Pdf::loadView('Dashboard.attendence.section_pdf', [
                'students'      => $students,
                'days'          => $days,
                'from'          => $from->toDateString(),
                'to'            => $to->toDateString(),
                'id'            => $id,
                'name'          => $name,
                'attendanceMap' => $attendanceMap,
                'year'          => $year,
                'month'         => $month,
            ])->setPaper('a4', 'landscape');

            return $pdf->download($fileName);
        }

        return view('Dashboard.attendence.section', [
            'students'      => $students,
            'days'          => $days,
            'from'          => $from->toDateString(),
            'to'            => $to->toDateString(),
            'id'            => $id,
            'name'          => $name,
            'attendanceMap' => $attendanceMap,
            'months'        => $months,
            'year'          => $year,
            'month'         => $month,
        ]);
    }

    private function makeDaysRange(Carbon $from, Carbon $to): array
    {
        $start = $from->copy()->startOfDay();
        $end   = $to->copy()->startOfDay();

        $days = [];
        while ($start->lte($end)) {
            $days[] = $start->toDateString();
            $start->addDay();
        }
        return $days;
    }

    public function edit($id) {}

    public function update($request) {}

    public function destroy($request) {}
}
