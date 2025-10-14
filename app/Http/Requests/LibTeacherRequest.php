<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LibTeacherRequest extends FormRequest
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
            'grad_id'=>'required',
            'class_id'=>'required',
            'sect_id'=>'required',
            'title_ar'=>'required',
            'title_en'=>'required',
            'file_name' => 'required|array',
            'file_name.*'=>'file|mimes:pdf,ppt,doc,docs,pptx|max:102400',
        ];
    }

    public function messages(){
        return [
            'grad_id.required'=>__('Students_trans.Name of Grade is required'),
            'class_id.required'=>__('Students_trans.Name of Classroom is Required'),
            'sect_id.required'=>__('Students_trans.Section Name is Required'),
            'title_ar.required'=>__('Students_trans.Title Arabic is required'),
            'title_en.required'=>__('Students_trans.Title English is required'),
            'file_name.file' =>__('Students_trans.the file must be file'),
            'file_name.mimes' =>__('Students_trans.the type of file must be in pdf,ppt,doc,docs,pptx'),
            'file_name.max' =>__('Students_trans.the size of file must be not greater than 10 m'),
        ];
    }
}
