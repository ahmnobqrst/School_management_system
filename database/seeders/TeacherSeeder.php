<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Specialist;
use App\Models\Gender;
use App\Models\Teacher;
use Hash;
use DB;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('teachers')->delete();
        $teacher = new Teacher();
        $teacher->email = "abogaber@gmail.com";
        $teacher->password = Hash::make('12344321');
        $teacher->name = ['ar'=>'احمد','en'=>'ahmed'];
        $teacher->specialist_id = Specialist::all()->unique()->random()->id;
        $teacher->gender_id = Gender::all()->unique()->random()->id;
        $teacher->address = ['ar'=>'بني سويف','en'=>'beni suef'];
        $teacher->age = '27';
        $teacher->date_of_job = '2020-01-01';
        $teacher->save();

        
    }
}
