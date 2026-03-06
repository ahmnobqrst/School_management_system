<?php

namespace Database\Factories;

use App\Models\Specialist; // تأكد من عمل import للموديلات
use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class TeacherFactory extends Factory
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
            'address' => [
                'en' => $fakerEn->address,
                'ar' => $fakerAr->address
            ],
            'age' => $this->faker->numberBetween(25, 50),
            'date_of_job' => $this->faker->date('Y-m-d', 'now'),
            'phone' => $this->faker->phoneNumber,
            'gender_id' => $this->faker->randomElement([1, 2]),

            'grade_id' => Grade::all()->random()->id,
            'specialist_id' => Specialist::all()->random()->id,

            'national_teacher_id' => $this->faker->unique()->numberBetween(100000, 999999),
            'blood_type_teacher_id' => $this->faker->numberBetween(1, 8),
            'image' => null,
        ];
    }
}
