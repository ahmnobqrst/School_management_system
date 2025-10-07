<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherQuestionRequest extends FormRequest
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
            'answer_ar'=>'required|string',
            'answer_en'=>'required|string',
            'right_answer_ar'=>'required|string',
            'right_answer_en'=>'required|string',
            'degree'=>'required|numeric',
            'quiz_id'=>'required',
        ];
    }

    public function messages()
{
    return [
        'name_ar.required' => trans('Students_trans.name_ar_required'),
        'name_en.required' => trans('Students_trans.name_en_required'),
        'answer_ar.required' => trans('Students_trans.answer_ar_required'),
        'answer_en.required' => trans('Students_trans.answer_en_required'),
        'right_answer_ar.required' => trans('Students_trans.right_answer_ar_required'),
        'right_answer_en.required' => trans('Students_trans.right_answer_en_required'),
        'degree.required' => trans('Students_trans.degree_required'),
        'degree.numeric' => trans('Students_trans.degree_numeric'),
        'quiz_id.required' => trans('Students_trans.quiz_id_required'),
    ];
}
}
