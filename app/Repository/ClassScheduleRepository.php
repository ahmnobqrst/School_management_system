<?php

namespace App\Repository;

use App\Interface\ClassScheduleInterface;
use App\Models\ClassSchedule;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClassScheduleRepository implements ClassScheduleInterface
{

    public function index()
    {
        $schedules = ClassSchedule::with(['teacher', 'subject', 'section'])
            ->get()
            ->groupBy(['day', 'period']);

        $days = ['sun', 'mon', 'tue', 'wed', 'thu'];
        $maxPeriods = 6;

        return view('Dashboard.timelab.index', compact('schedules', 'days', 'maxPeriods'));
    }
    public function store($request) {
        try {
        ClassSchedule::create([
            'day' => $request->day,
            'period' => $request->period,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'teacher_id' => $request->teacher_id,
            'section_id' => $request->section_id,
            'subject_id' => $request->subject_id,
            'grade_id' => $request->grad_id,
            'classroom_id' => $request->classroom_id,
        ]);
        
        toastr()->success(trans('messages.success'));
        return redirect()->route('timetable.index');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
    }
    public function edit($id) {}
    public function create()
    {
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = Teacher::all();
        return view('Dashboard.timelab.create', $data);
    }
    public function update($request) {}
    public function destroy($request) {}
}
