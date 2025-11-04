<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
            // 'section_name_ar'=>'required|string',
            // 'section_name_en'=>'required|string',
            // 'teacher_id'=>'required|exists:teachers,id',
            // 'Class_id'=>'required|exists:classrooms,id',
            // 'Grade_id'=>'required|exists:grades,id',
            // 'section_name_ar'=>'required|string|unique:sections,section_name->ar',
            // 'section_name_en'=>'required|string|unique:sections,section_name->en',
             'section_name_ar' => 'required|string',
        'section_name_en' => 'required|string',
        'teacher_id' => 'required|array',
        'teacher_id.*' => 'exists:teachers,id',
        'Class_id' => 'required|exists:classrooms,id',
        'Grade_id' => 'required|exists:grades,id',
        ];
    }

    public function messages(){
        return [
            'section_name_ar.required'=>__('section_trans.name_ar is required'),
            'section_name_ar.string'=>__('section_trans.name_ar must be string'),
            'section_name_ar.unique'=>trans('section_trans.unique_section'),
            'section_name_en.required'=>__('section_trans.name_en is required'),
            'section_name_en.string'=>__('section_trans.name_en must be string'),
            'teacher_id.required'=>__('section_trans.Teacher Name is required'),
            'Class_id.required'=>__('section_trans.Classroom Name is required'),
            'Grade_id.required'=>__('section_trans.Grade Name is required'),
            // 'section_name_en.unique_'=>trans('section_trans.unique_section_en'),
        ];
    }
}
