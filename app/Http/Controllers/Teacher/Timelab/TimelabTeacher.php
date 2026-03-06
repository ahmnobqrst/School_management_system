<?php

namespace App\Http\Controllers\Teacher\Timelab;

use App\Http\Controllers\Controller;
use App\Models\ClassSchedule;
use Illuminate\Http\Request;

class TimelabTeacher extends Controller
{
    public function index()
    {
        $days = ['sun', 'mon', 'tue', 'wed', 'thu'];
        $maxPeriods = 6;

        $allSchedules = ClassSchedule::with(['grade', 'classroom', 'section', 'subject'])
            ->where('teacher_id', auth()->user()->id)
            ->get();

        $schedules = [];
        foreach ($allSchedules as $item) {
            $schedules[$item->day][$item->period][] = $item;
        }

        return view('Dashboard.teacher.timelab.index', compact('schedules', 'days', 'maxPeriods'));
    }
}
