<?php

namespace App\Http\Controllers\Student\Timelab;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ClassSchedule, Student, Teacher, Setting};

class TimelabStudent extends Controller
{
    public function index()
    {

        $days = ['sun', 'mon', 'tue', 'wed', 'thu'];
        $maxPeriods = 6;

        $allSchedules = ClassSchedule::with(['grade', 'classroom', 'section', 'subject', 'teacher'])
            ->where('section_id', auth()->user()->section_id)
            ->get();

        $schedules = [];
        foreach ($allSchedules as $item) {
            $schedules[$item->day][$item->period][] = $item;
        }

        return view('Data.Student.timelab.index', compact('schedules', 'days', 'maxPeriods'));
    }

    public function son_timelab()
    {
        $days = ['sun', 'mon', 'tue', 'wed', 'thu'];
        $maxPeriods = 6;

        $children = Student::where('parent_id', auth()->user()->id)->get();
        $sectionIds = $children->pluck('section_id')->unique()->toArray();

        $allSchedules = ClassSchedule::with(['grade', 'classroom', 'section', 'subject', 'teacher'])
            ->whereIn('section_id', $sectionIds)
            ->get();

        $childrenSchedules = [];
        foreach ($children as $child) {
            $childSchedules = $allSchedules->where('section_id', $child->section_id);
            foreach ($childSchedules as $item) {
                $childrenSchedules[$child->id][$item->day][$item->period][] = $item;
            }
        }

        return view('Dashboard.parents.timelab.index', compact('children', 'childrenSchedules', 'days', 'maxPeriods'));
    }

    public function son_teachers()
    {
        $children = Student::where('parent_id', auth()->user()->id)->get();

        $teachers = Teacher::whereHas('Sections', function ($query) use ($children) {
            $query->whereIn('teacher_section.section_id', $children->pluck('section_id'));
        })->get();

        return view('Dashboard.parents.childerns.teachers', compact('children', 'teachers'));
    }

    public function settings()
    {
        $settings = Setting::all();
        return view('Dashboard.parents.settings', compact('settings'));
    }
    public function student_settings()
    {
        $settings = Setting::all();
        return view('Dashboard.student.settings', compact('settings'));
    }
    public function teacher_settings()
    {
        $settings = Setting::all();
        return view('Dashboard.teacher.settings', compact('settings'));
    }
}
