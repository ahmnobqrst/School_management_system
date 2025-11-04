<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\National;
use App\Models\BloodType;
use App\Models\Religions;
use App\Models\MyParent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PerentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('my_parents')->delete();
        $my_parent = new MyParent();
        $my_parent->email = "ahmed@gmail.com";
        $my_parent->password = Hash::make('12344321');

        $my_parent->name_of_father = ['ar'=>"احمد جابر",'en'=>"ahmed gaber"];
        $my_parent->father_phone = "01065543072";
        $my_parent->father_job =  ['ar'=>"مهندس برمجيات",'en'=>"software engineering"];
        $my_parent->father_ID = "298092084654674";
        $my_parent->father_address = ['ar'=>"بني سويف",'en'=>"beni suef"];
        $my_parent->national_father_id =  National::all()->unique()->random()->id;
        $my_parent->blood_type_father_id =  BloodType::all()->unique()->random()->id;
        $my_parent->religion_father_id = Religions::all()->unique()->random()->id;
        $my_parent->name_of_mother = ['ar'=>"نورا ربيع",'en'=>"nora rabea"];
        $my_parent->mother_phone = "01065543072";
        $my_parent->mother_job = ['ar'=>"فنية تحاليل",'en'=>"labbing"];
        $my_parent->mother_ID = "200383873367";
        $my_parent->mother_address =  ['ar'=>"بني سويف",'en'=>"beni suef"];
        $my_parent->national_mother_id = National::all()->unique()->random()->id;
        $my_parent->blood_type_mother_id = BloodType::all()->unique()->random()->id;
        $my_parent->save();
    }
}
