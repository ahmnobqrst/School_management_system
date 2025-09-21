<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_ar'=>'required|string',
            'name_en'=>'required|string',
            'amount'=>'required|numeric',
            'year'=>'required',
            'grade_id'=>'required|integer',
            'classroom_id'=>'required|integer',
            // 'fee_type'=>'required',
        ];
    }

    public function messages(){
        return [
            'name_ar.required'=>__('fee_trans.name_ar is required'),
            'name_ar.string'=>__('fee_trans.name_ar must be string'),
            'name_en.required'=>__('fee_trans.name_en is required'),
            'name_en.string'=>__('fee_trans.name_en must be string'),
            'amount.required'=>__('fee_trans.amount is required'),
            'amount.numeric'=>__('fee_trans.amount must be numeric'),
            'year.required'=>__('fee_trans.academic_year required'),
            'grade_id.required'=>__('fee_trans.grade_id is required'),
            'classroom_id.required'=>__('fee_trans.classroom_id is required'),
            
        ];
    }
}
