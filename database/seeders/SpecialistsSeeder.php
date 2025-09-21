<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Specialist;
use Illuminate\Support\Facades\DB;

class SpecialistsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('specialists')->delete(); //ده علشان لما اجي انفذ ال seeder مرة تانية يحذف الاول ويضبف من جديد
        
        $specialists = [
            [
                
                "en" => "Arabic",
                "ar" => "لغة عربية"
            ],
            [
                
                "en" => "English",
                "ar" => "انجليزي"
            ],
            [
                
                "en" => "scince",
                "ar" => "علوم",
            ],
            [
                
                "en" => "math",
                "ar" => "رياضيات"
            ],
            [
                
                "en" => "computer",
                "ar" => "حاسب ألي",
            ],
            [
                
                "en" => "games teacher",
                "ar" => "مدرس ألعاب",
            ],
        
        ];

        foreach($specialists as $specialist){
            Specialist::create(['name'=>$specialist]);
        }
    }
}
