<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\ClassSchedule;

class TimetableRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'day' => 'required|in:sun,mon,tue,wed,thu',
            'period' => 'required|integer|min:1|max:8',
            'subject_id' => 'required|exists:subjects,id',
            'grade_id' => 'required|exists:grades,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id',
            'teacher_id' => 'required|exists:teachers,id',
            'start_time' => 'required|after_or_equal:08:00|before_or_equal:17:00|after_or_equal:today',
            'end_time' => 'required|after:start_time',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $teacherConflict = ClassSchedule::where('day', $this->day)
                ->where('period', $this->period)
                ->where('teacher_id', $this->teacher_id)
                ->exists();

            if ($teacherConflict) {
                $validator->errors()->add('teacher_id', trans('Students_trans.teacher_conflict'));
            }

            $sectionConflict = ClassSchedule::where('day', $this->day)
                ->where('period', $this->period)
                ->where('section_id', $this->section_id)
                ->exists();

            if ($sectionConflict) {
                $validator->errors()->add('section_id', trans('Students_trans.section_conflict'));
            }
        });
    }

    public function messages(): array
    {
        return [
            'day.required' => trans('Students_trans.day_required'),
            'period.required' => trans('Students_trans.period_required'),
            'end_time.after' => trans('Students_trans.end_time_after'),
            'start_time.after_or_equal' => trans('Students_trans.after_or_equal_8_morning'),
            'start_time.after_or_equal' => trans('Students_trans.after_or_equal'),
            'start_time.before_or_equal' => trans('Students_trans.before_or_equal'),
            'teacher_id.required' => trans('Students_trans.teacher_id_required'),
            'section_id.required' => trans('Students_trans.section_id_required'),
            'subject_id.required' => trans('Students_trans.subject_id_required'),
            'grade_id.required' => trans('Students_trans.grade_id_required'),
            'classroom_id.required' => trans('Students_trans.classroom_id_required'),
            
        ];
    }
}