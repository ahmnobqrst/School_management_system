<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
            'email'                 => 'required|unique:teachers,email,' . $this->id,
            'name_ar'               => 'required|string',
            'name_en'               => 'required|string',
            'address_ar'            => 'string',
            'address_en'            => 'string',
            'phone'                 => 'numeric|unique:teachers,phone,' . $this->id,
            'age'                   => 'numeric',
            'specialist_id'         => 'required',
            'gender_id'             => 'required',
            'national_teacher_id'   => 'required',
            'blood_type_teacher_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required'                 => __('teacher_trans.email is required'),
            'email.unique'                   => trans('teacher_trans.email_unique'),
            'name_ar.required'               => __('teacher_trans.name_ar is required'),
            'name_ar.string'                 => __('teacher_trans.name_ar must be string'),
            'name_en.required'               => __('teacher_trans.name_en is required'),
            'name_en.string'                 => __('teacher_trans.name_en must be string'),
            'address_ar.string'              => __('teacher_trans.address_ar must be string'),
            'address_en.string'              => __('teacher_trans.address_en must be string'),
            'age.numeric'                    => __('teacher_trans.age must be number'),
            'phone.numeric'                  => __('teacher_trans.phone must be number'),
            'phone.unique'                   => __('teacher_trans.phone Already Exists'),
            'specialist_id.required'         => __('teacher_trans.specialist_id is required'),
            'gender_id.required'             => __('teacher_trans.gender_id is required'),
            'national_teacher_id.required'   => __('teacher_trans.national_teacher_id is required'),
            'blood_type_teacher_id.required' => __('teacher_trans.blood_type_teacher_id is required'),

        ];
    }
}
