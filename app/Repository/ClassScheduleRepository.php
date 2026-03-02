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

        $grades = Grade::all();
        $days = ['sun', 'mon', 'tue', 'wed', 'thu'];
        $maxPeriods = 6;

        $allSchedules = ClassSchedule::with(['grade', 'classroom', 'section', 'subject', 'teacher'])->get();

        $schedules = [];
        foreach ($allSchedules as $item) {
            $schedules[$item->grade_id][$item->day][$item->period][] = $item;
        }

        return view('Dashboard.timelab.index', compact('schedules', 'days', 'maxPeriods', 'grades'));
    }
    public function store($request)
    {
        try {
            ClassSchedule::create($request->validated());
            toastr()->success(trans('Students_trans.timetable_added_successfully'));
            return redirect()->route('timetable.index');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors([
                'error' => trans('Students_trans.Update_Error')
            ]);
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
