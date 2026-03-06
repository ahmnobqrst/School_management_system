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
use App\Services\AttendanceFilterService;
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
        $filter = new AttendanceFilterService($request);

        $days   = $filter->getDaysRange();
        $months = $filter->getMonthsList();

        $students = Student::with([
            'Grade',
            'Section',
            'attendance' => function ($q) use ($filter, $id) {
                $q->where('section_id', $id)
                    ->whereBetween('attendence_date', [$filter->fromString(), $filter->toString()]);
            }
        ])
            ->where('section_id', $id)
            ->when($filter->name, function ($q) use ($filter) {
                $q->where('name', 'like', "%{$filter->name}%");
            })
            ->orderBy('name')
            ->get();

        $attendanceMap = [];
        foreach ($students as $student) {
            foreach ($student->attendance as $att) {
                $date = is_object($att->attendence_date)
                    ? $att->attendence_date->format('Y-m-d')
                    : Carbon::parse($att->attendence_date)->format('Y-m-d');

                $attendanceMap[$student->id][$date] = (int) $att->attendence_status;
            }
        }

        $viewData = [
            'students'      => $students,
            'days'          => $days,
            'from'          => $filter->fromString(),
            'to'            => $filter->toString(),
            'id'            => $id,
            'name'          => $filter->name,
            'attendanceMap' => $attendanceMap,
            'months'        => $months,
            'year'          => $filter->year,
            'month'         => $filter->month,
        ];

        if ($request->get('export') === 'excel') {
            $fileName = "attendance_section_{$id}_{$filter->from->format('Ymd')}_{$filter->to->format('Ymd')}.xlsx";

            return Excel::download(
                new AttendanceReportExport($students, $days, $filter->fromString(), $filter->toString(), (int)$id, $filter->name),
                $fileName
            );
        }

        if ($request->get('export') === 'pdf') {
            $fileName = "attendance_section_{$id}_{$filter->from->format('Ymd')}_{$filter->to->format('Ymd')}.pdf";

            $pdf = Pdf::loadView('Dashboard.attendence.section_pdf', $viewData)
                ->setPaper('a4', 'landscape');

            return $pdf->download($fileName);
        }

        return view('Dashboard.attendence.section', $viewData);
    }

    public function edit($id) {}

    public function update($request) {}

    public function destroy($request) {}
}
