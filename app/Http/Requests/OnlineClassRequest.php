<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OnlineClassRequest extends FormRequest
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
            'grade_id'=>'required',
            'classroom_id'=>'required',
            'section_id'=>'required',
            'topic_ar'=>'required|unique:online__classes,topic->en,',
            'topic_en'=>'required|unique:online__classes,topic->en,',
            'start_time'=>'required|date',
            'duration'=>'required|numeric',
        ];
    }

    public function messages(){
        return [
            'grade_id.required'=>__('Students_trans.Name of Grade is required'),
            'classroom_id.required'=>__('Students_trans.Name of Classroom is Required'),
            'section_id.required'=>__('Students_trans.Section Name is Required'),
            'topic_ar.unique'=>trans('Students_trans.Topic Arabic must be unique'),
            'topic_ar.required'=>__('Students_trans.Topic Arabic is required'),
            'topic_en.unique'=>trans('Students_trans.Topic English must be unique'),
            'topic_en.required'=>__('Students_trans.Topic English is required'),
            'start_time.required'=>__('Students_trans.Start Time is required'),
            'start_time.date'=>__('Students_trans.Start Time must be date'),
            'duration.required'=>__('Students_trans.duration is required'),
            'duration.date'=>__('Students_trans.duration must be numeric'),
        ];
    }
}
