<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'  => 'nullable|string|max:255',
            'from'  => 'nullable|date|date_format:Y-m-d|before_or_equal:today',
            'to'    => 'nullable|date|date_format:Y-m-d|after_or_equal:from',
            'month' => 'nullable|integer|min:1|max:12',
            'year'  => 'nullable|integer|min:2000|max:2100',
            'export'=> 'nullable|in:pdf,excel',
        ];
    }

    public function messages()
    {
        return [
            'student_id.required' => trans('Students_trans.Student_name'),
            'from.required' => trans('Students_trans.from_required'),
            'from.date' => trans('Students_trans.date'),
            'from.date_format' => trans('Students_trans.date_format'),
            'from.before_or_equal' => trans('Students_trans.before_or_equal'),
            'to.required' => trans('Students_trans.to_required'),
            'to.date' => trans('Students_trans.date_to'),
            'to.date_format' => trans('Students_trans.to_date_format'),
            'to.after_or_equal' => trans('Students_trans.after_or_equal'),
        ];
    }
}