<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GradeRequest extends FormRequest
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
            // 'name_en' => ['required', Rule::unique('grades', 'name->' . 'en').$this->id],
            // 'name_ar' => ['required', Rule::unique('grades', 'name->' . 'ar').$this->id],
            //'name_ar'=>'required|string|unique:grades,name->ar,'.$this->id,
            //'name_en'=>'required|string|unique:grades,name->en,'.$this->id,

            // 'grades.name_ar' => ['required', 'string', 'unique:'.Grade::class.',name->ar,'.$this->id],
            // 'grades.name_en' => ['required', 'string', 'unique:'.Grade::class.',name->en,'.$this->id],

            'name_ar'=>'required|string|unique:grades,name->ar,'.$this->id,
            'name_en'=>'required|string|unique:grades,name->en,'.$this->id,
            // 'desc_ar'=>'string|required|max:100',
            // 'desc_en'=>'string|required|max:100',
        ];
    }

    public function messages(){
        return [
            'name_ar.required'=>__('grades_trans.name_ar is required'),
            'name_ar.string'=>__('grades_trans.name_ar must be string'),
            'name_ar.unique'=>trans('class_trans.unique_grade'),
            'name_en.required'=>__('grades_trans.name_en is required'),
            'name_en.string'=>__('grades_trans.name_en must be string'),
            'name_en.unique'=>trans('class_trans.unique_grade'),
            // 'desc_ar.required'=>__('grades_trans.desc_ar must be required'),
            // 'desc_ar.max'=>__('grades_trans.desc_ar must be greate or equal 100 '),
            // 'desc_ar.string'=>__('grades_trans.desc_ar must be string'),
            // 'desc_en.required'=>__('grades_trans.desc_en must be required'),
            // 'desc_en.max'=>__('grades_trans.desc_en must be greate or equal 100 '),
            // 'desc_en.string'=>__('grades_trans.desc_en must be string'),
        ];
    }
}
