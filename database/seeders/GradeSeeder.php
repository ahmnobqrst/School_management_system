<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Translatable\HasTranslations;
use App\Models\Grade;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('grades')->delete(); //ده علشان لما اجي انفذ ال seeder مرة تانية يحذف الاول ويضبف من جديد
        $grades = [
            [
                
                "en" => "primary stage",
                "ar" => "المرحلة الابتدائية"
            ],
            [
                
                "en" => "seccond stage",
                "ar" => "المرحلة الاعدادية"
            ],
            [
                
                "en" => "high school",
                "ar" => "المرحلة الثانوية"
            ],
        
        ];

           foreach($grades as $grade){
            Grade::create(['name'=>$grade]);
           }
    }
        
    
}
