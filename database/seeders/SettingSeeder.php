<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\DB;
use App\Model\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('settings')->delete();

       $data = [
    [
        'key' => json_encode(['ar' => 'اسم المدرسة', 'en' => 'school_name']),
        'value' => json_encode(['ar' => 'حمزة اسكول', 'en' => 'Hamza School international']),
    ],
    [
        'key' => json_encode(['ar' => 'الاسم التجاري', 'en' => 'school_title']),
        'value' => json_encode(['ar' => 'حمزة اسكول', 'en' => 'HSI']),
    ],
    [
        'key' => json_encode(['ar' => 'العام الدراسي الحالي', 'en' => 'current_Academic_Year']),
        'value' => json_encode(['ar' => '2025-2026', 'en' => '2025-2026']),
    ],
    [
        'key' => json_encode(['ar' => 'عنوان المدرسة', 'en' => 'school_address']),
        'value' => json_encode(['ar' => 'القاهرة', 'en' => 'cairo']),
    ],
    [
        'key' => json_encode(['ar' => 'تليفون المدرسة', 'en' => 'school_phone']),
        'value' => json_encode(['ar' => '01065542072', 'en' => '01065542072']),
    ],
    [
        'key' => json_encode(['ar' => 'ايميل المدرسة', 'en' => 'school_email']),
        'value' => json_encode(['ar' => 'ahmedazoz799@gmail.com', 'en' => 'ahmedazoz799@gmail.com']),
    ],
    [
        'key' => json_encode(['ar' => 'نهاية الفصل الدراسي الاول', 'en' => 'end_first_term']),
        'value' => json_encode(['ar' => '1-09-2025', 'en' => '1-09-2025']),
    ],
    [
        'key' => json_encode(['ar' => 'نهاية الفصل الدراسي الثاني', 'en' => 'end_second_term']),
        'value' => json_encode(['ar' => '1-06-2026', 'en' => '1-06-2026']),
    ],
    [
        'key' => json_encode(['ar' => 'الشعار', 'en' => 'Logo']),
        'value' => json_encode(['ar' => '1.png', 'en' => '1.png']),
    ],
];


       DB::table('settings')->insert($data);
    }
}