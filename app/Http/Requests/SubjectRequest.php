<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_ar'=>'required|string',
            'name_en'=>'required|string',
            'grade_id'=>'required',
            'classroom_id'=>'required',
            'teacher_id'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'name_ar.required'=>__('Students_trans.Arabic name required'),
            'name_ar.string'=>trans('Students_trans.Arabic name must be string'),
            'name_en.required'=>__('Students_trans.English name required'),
            'name_en.string'=>trans('Students_trans.English name must be string'),
            'grade_id'=>__('Students_trans.Grade required'),
            'classroom_id'=>trans('Students_trans.Classroom required'),
            'teacher_id'=>__('Students_trans.Teacher required'),
        ];
    }
}
