<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassRequest extends FormRequest
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
            "class_list.*.name_ar" => 'required',
            "class_list.*.name_en" => 'required',
        ];
    }
    public function messages(){
        return [
             'name_ar.required'=>__('class_trans.name_ar is required'),
             'name_ar.string'=>__('class_trans.name_ar must be string'),
            //  'name_ar.unique'=>trans('class_trans.unique'),
             'name_en.required'=>__('class_trans.name_en is required'),
            // 'name_en.string'=>__('class_trans.name_en must be string'),
            //  'name_en.unique'=>trans('class_trans.unique'),
            // 'desc_ar.required'=>__('class_trans.desc_ar must be required'),
            // 'desc_ar.max'=>__('class_trans.desc_ar must be greate or equal 100 '),
            // 'desc_ar.string'=>__('class_trans.desc_ar must be string'),
            // 'desc_en.required'=>__('class_trans.desc_en must be required'),
             'name_ar'=>__('class_trans.name_ar must be greate or equal 3'),
            // 'desc_en.string'=>__('class_trans.desc_en must be string'),
        ];
    }
}
