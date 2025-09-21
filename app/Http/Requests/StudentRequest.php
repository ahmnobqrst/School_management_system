<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'email'=>'required|unique:students,email,'.$this->id,
            'password'=>'required|min:8',
            'birth_of_date'=>'date|required',
            'academic_year'=>'required',
            'national_student_id'=>'required',
            'blood_type_student_id'=>'required',
            'gender_id'=>'required',
            'grade_id'=>'required',
            'parent_id'=>'required',
            'classroom_id'=>'required',
            'section_id'=>'required',
        ];
    }

    public function messages(){
        return [
            'email.required'=>__('Students_trans.email is required'),
            'email.unique'=>trans('Students_trans.email_unique'),
            'password.required'=>trans('Students_trans.password_required'),
            'password.min'=>trans('Students_trans.length of password'),
            'name_ar.required'=>__('Students_trans.name_ar is required'),
            'name_ar.string'=>__('Students_trans.name_ar must be string'),
            'name_en.required'=>__('Students_trans.name_en is required'),
            'name_en.string'=>__('Students_trans.name_en must be string'),
            'birth_of_date.date'=>__('Students_trans.birth_of_date must be string'),
            'birth_of_date.required'=>__('Students_trans.birth_of_date required'),
            'academic_year.required'=>__('Students_trans.academic_year required'),
            'national_student_id.required'=>__('Students_trans.national_student_id is required'),
            'blood_type_student_id.required'=>__('Students_trans.blood_type_student_id is required'),
            'gender_id.required'=>__('Students_trans.gender_id is required'),
            'grade_id.required'=>__('Students_trans.grade_id is required'),
            'parent_id.required'=>__('Students_trans.parent_id is required'),
            'classroom_id.required'=>__('Students_trans.classroom_id is required'),
            'section_id.required'=>__('Students_trans.section_id is required'),
            
        ];
    }
}
