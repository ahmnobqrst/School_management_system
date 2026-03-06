<?php

namespace Database\Factories;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassroomFactory extends Factory
{
    protected $model = Classroom::class;

    private static int $counter = 0;

    private static array $namesAr = [
        'الفصل الأول',
        'الفصل الثاني',
        'الفصل الثالث',
        'الفصل الرابع',
        'الفصل الخامس',
        'الفصل السادس',
        'الفصل الاول الاعدادي',
        'الفصل الثاني الاعدادي',
        'الفصل الثالث الاعدادي',
        'الفصل الاول الثانوي',
        'الفصل الثاني الثانوي',
        'الفصل الثالث الثانوي',
    ];

    public function definition(): array
    {
        $index = self::$counter % 10;
        self::$counter++;

        return [
            'name' => [
                'en' => 'Class ' . ($index + 1),
                'ar' => self::$namesAr[$index],
            ],
            'desc' => [
                'en' => 'Classroom number ' . ($index + 1),
                'ar' => 'وصف ' . self::$namesAr[$index],
            ],
            'Grade_id' => \App\Models\Grade::all()->random()->id,
        ];
    }
}
