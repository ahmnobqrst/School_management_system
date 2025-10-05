<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PublicEnglishName;
use App\Rules\PublicArabicName;

class QuizTeacherRequest extends FormRequest
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
            'name_ar'=>['required','string', new PublicArabicName],
            'name_en'=>['required','string', new PublicEnglishName],
            'grade_id'=>['required'],
            'classroom_id'=>['required'],
            'section_id'=>['required'],
        ];
    }
}
