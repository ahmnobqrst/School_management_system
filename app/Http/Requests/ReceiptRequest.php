<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceiptRequest extends FormRequest
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

    public function messages(){
        return [
            'Debit.required'=>__('fee_trans.amount is required'),
            'Debit.numeric'=>__('fee_trans.amount must be numeric'),
            'description_ar.required'=>__('fee_trans.description_ar reqired'),
            'description_ar.string'=>__('fee_trans.description_ar must be string'),
            'description_en.required'=>__('fee_trans.description_en reqired'),
            'description_en.string'=>__('fee_trans.description_en must be string'),
        ];
    }
}
