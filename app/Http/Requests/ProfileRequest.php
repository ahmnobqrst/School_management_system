<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**``
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_ar'=>'required|string',
            'name_en'=>'required|string',
            'password'=>'nullable|max:14|min:6',
            'image'=>'nullable|image',
        ];
    }

     public function messages()
    {
        return [
            'name_ar.required'               => __('teacher_trans.name_ar is required'),
            'name_ar.string'                 => __('teacher_trans.name_ar must be string'),
            'name_en.required'               => __('teacher_trans.name_en is required'),
            'name_en.string'                 => __('teacher_trans.name_en must be string'),
        ];
    }
}
