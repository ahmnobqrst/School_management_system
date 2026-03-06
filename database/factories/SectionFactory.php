<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class SectionFactory extends Factory
{
    private static int $counter = 0;

    private static array $namesAr = [
        'القسم الأول الابتدائي',
        'القسم الثاني الابتدائي',
        'القسم الثالث الابتدائي',
        'القسم الرابع الابتدائي',
        'القسم الخامس الابتدائي',
        'القسم السادس الابتدائي',
        'القسم الاول الاعدادي',
        'القسم الثاني الاعدادي',
        'القسم الثالث الاعدادي',
        'القسم الرابع الاعدادي',
        'القسم الخامس الاعدادي',
        'القسم السادس الاعدادي',
        'القسم الاول الثانوي',
        'القسم الثاني الثانوي',
        'القسم الثالث الثانوي',
    ];

    public function definition(): array
    {
        $index = self::$counter % 10;
        self::$counter++;

        return [
            'section_name' => [
                'en' => 'Primary Section ' . ($index + 1),
                'ar' => self::$namesAr[$index],
            ],
            'status' => $this->faker->numberBetween(0, 1),

            'Grade_id' => \App\Models\Grade::inRandomOrder()->first()?->id ?? 1,
            'Class_id' => \App\Models\Classroom::inRandomOrder()->first()?->id ?? 1,

            'capacity' => $this->faker->numberBetween(15, 40),
        ];
    }
}
