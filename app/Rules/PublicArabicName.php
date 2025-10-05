<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PublicArabicName implements ValidationRule
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

        if (preg_match('/^[0-9٠-٩\s]+$/u', $value)) {
            $fail(__('Students_trans.numbers_only', ['attribute' => $attributeName]));
            return;
        }

        if (!preg_match('/\p{Arabic}/u', $value)) {
            $fail(__('Students_trans.must_contain_arabic', ['attribute' => $attributeName]));
            return;
        }

        if (preg_match('/[A-Za-z]/', $value)) {
            $fail(__('Students_trans.no_english_allowed', ['attribute' => $attributeName]));
            return;
        }

        if (preg_match('/[^\p{Arabic}0-9٠-٩\s.,!?;:\'"(){}\[\]_+=\-@#$%^&*~`|\/]/u', $value)) {
            $fail(__('Students_trans.invalid_characters', ['attribute' => $attributeName]));
            return;
        }
    }
}
