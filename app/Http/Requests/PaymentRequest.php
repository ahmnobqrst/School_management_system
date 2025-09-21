<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'Debit'=>'required|numeric',
            'description_ar'=>'required|string',
            'description_en'=>'required|string',
        ];
    }

    public function message(){
        return [
            'Debit.required'=>__('Students_trans.the amount is required'),
            'Debit.numeric'=>__('Students_trans.the amount must be in number'),
            'description_ar.required'=>__('Students_trans.the description_ar is required'),
            'description_ar.string'=>__('Students_trans.the description_ar must be string'),
            'description_en.required'=>__('Students_trans.the description_en is required'),
            'description_en.string'=>__('Students_trans.the description_en must be string'),

        ];
         
    }
}
