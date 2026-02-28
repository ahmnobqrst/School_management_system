<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AttendanceReportExport implements FromView
{
    public function __construct(
        public $students,
        public array $days,
        public string $from,
        public string $to,
        public int $sectionId,
        public string $nameFilter = ''
    ) {}

    public function view(): View
    {
        $attendanceMap = [];
        foreach ($this->students as $student) {
            foreach ($student->attendance as $att) {
                $date = is_object($att->attendence_date)
                    ? $att->attendence_date->format('Y-m-d')
                    : \Carbon\Carbon::parse($att->attendence_date)->format('Y-m-d');

                $attendanceMap[$student->id][$date] = (int) $att->attendence_status;
            }
        }

        return view('Dashboard.attendence.section_excel', [
            'students'      => $this->students,
            'days'          => $this->days,
            'from'          => $this->from,
            'to'            => $this->to,
            'attendanceMap' => $attendanceMap,
            'sectionId'     => $this->sectionId,
            'name'          => $this->nameFilter,
        ]);
    }
}
