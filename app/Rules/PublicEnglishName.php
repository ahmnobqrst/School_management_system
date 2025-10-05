<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PublicEnglishName implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
         $attributeName = __("Students_trans.$attribute");

        if (empty(trim($value))) {
            $fail(__('Students_trans.required_field', ['attribute' => $attributeName]));
            return;
        }

        if (preg_match('/^[0-9\s]+$/', $value)) {
            $fail(__('Students_trans.numbers_only', ['attribute' => $attributeName]));
            return;
        }

        // لازم يحتوي على حرف إنجليزي
        if (!preg_match('/[A-Za-z]/', $value)) {
            $fail(__('Students_trans.must_contain_english', ['attribute' => $attributeName]));
            return;
        }

        // ممنوع يحتوي على أحرف عربية
        if (preg_match('/\p{Arabic}/u', $value)) {
            $fail(__('Students_trans.no_arabic_allowed', ['attribute' => $attributeName]));
            return;
        }

        // التحقق من الأحرف غير المسموحة
        if (preg_match('/[^A-Za-z0-9\s.,!?;:\'"(){}\[\]_+=\-@#$%^&*~`|\/]/u', $value)) {
            $fail(__('Students_trans.invalid_characters', ['attribute' => $attributeName]));
            return;
        }
    }
}
