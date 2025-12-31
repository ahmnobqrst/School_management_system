<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileParentRequest extends FormRequest
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
            'name_of_father_ar'=>'required|string',
            'name_of_father_en'=>'required|string',
            'password'=>'nullable|max:14|min:6',
            'image'=>'nullable|image',
        ];
    }

   public function messages()
{
    return [
        'name_of_father_ar.required' => __('teacher_trans.name_of_father_ar_required'),
        'name_of_father_ar.string'   => __('teacher_trans.name_of_father_ar_string'),

        'name_of_father_en.required' => __('teacher_trans.name_of_father_en_required'),
        'name_of_father_en.string'   => __('teacher_trans.name_of_father_en_string'),

        'password.min' => __('teacher_trans.password_min'),
        'password.max' => __('teacher_trans.password_max'),

        'image.image' => __('teacher_trans.image'),
    ];
}
}
