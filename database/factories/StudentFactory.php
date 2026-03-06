<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\Section;
use App\Models\MyParent;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class StudentFactory extends Factory
{
    public function definition(): array
    {
        $fakerAr = \Faker\Factory::create('ar_SA');
        $fakerEn = \Faker\Factory::create('en_US');

        return [
            'name' => [
                'en' => $fakerEn->name,
                'ar' => $fakerAr->name
            ],
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('12345678'),
            'birth_of_date' => $this->faker->date('Y-m-d', '2015-01-01'),
            'academic_year' => $this->faker->year,
            'gender_id' => $this->faker->randomElement([1, 2]),

            'parent_id' => MyParent::all()->random()->id,
            'grade_id' => Grade::all()->random()->id,
            'classroom_id' => Classroom::all()->random()->id,
            'section_id' => Section::all()->random()->id,

            'national_student_id' => $this->faker->unique()->numberBetween(100000, 999999),
            'blood_type_student_id' => $this->faker->numberBetween(1, 8),
            'image' => null,
        ];
    }
}
