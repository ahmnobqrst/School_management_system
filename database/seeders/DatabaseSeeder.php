<?php

namespace Database\Seeders;
use App\Models\{Classroom, Section, MyParent, Student, Teacher};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {

        $this->call(BloodSeeder::class);
        $this->call(NationalitySeeder::class);
        $this->call(ReligionSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(SpecialistsSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PerentSeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(SettingSeeder::class);

        Classroom::factory(10)->create();
        Teacher::factory(10)->create();
        Section::factory(10)->create();
        MyParent::factory(10)->create();
        Student::factory(10)->create();
    }
}
