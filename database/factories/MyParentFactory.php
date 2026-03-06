<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class MyParentFactory extends Factory
{

    public function definition(): array
    {

        $fakerAr = \Faker\Factory::create('ar_SA');
        $fakerEn = \Faker\Factory::create('en_US');

        return [
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('12345678'),

            'name_of_father' => [
                'en' => $fakerEn->name('male'),
                'ar' => $fakerAr->name('male')
            ],
            'name_of_mother' => [
                'en' => $fakerEn->name('female'),
                'ar' => $fakerAr->name('female')
            ],

            'father_phone' => $this->faker->phoneNumber,
            'mother_phone' => $this->faker->phoneNumber,

            'father_job' => [
                'en' => $fakerEn->jobTitle,
                'ar' => 'موظف'
            ],
            'mother_job' => [
                'en' => $fakerEn->jobTitle,
                'ar' => 'ربة منزل'
            ],

            'father_ID' => $this->faker->numerify('##############'),
            'mother_ID' => $this->faker->numerify('##############'),

            'father_address' => [
                'en' => $fakerEn->address,
                'ar' => $fakerAr->address
            ],
            'mother_address' => [
                'en' => $fakerEn->address,
                'ar' => $fakerAr->address
            ],

            'national_father_id' => \App\Models\National::inRandomOrder()->first()?->id ?? 1,
            'national_mother_id' => \App\Models\National::inRandomOrder()->first()?->id ?? 1,
            'blood_type_father_id' => \App\Models\BloodType::inRandomOrder()->first()?->id ?? 1,
            'blood_type_mother_id' => \App\Models\BloodType::inRandomOrder()->first()?->id ?? 1,
            'religion_father_id' => \App\Models\Religions::inRandomOrder()->first()?->id ?? 1,
            'image' => null,
        ];
    }
}
