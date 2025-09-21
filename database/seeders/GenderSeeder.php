<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gender;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genders')->delete(); //ده علشان لما اجي انفذ ال seeder مرة تانية يحذف الاول ويضبف من جديد
        $genders = [
            [
                
                "en" => "male",
                "ar" => "ذكر"
            ],
            [
                
                "en" => "female",
                "ar" => "أنثي"
            ],
            [
                
                "en" => "other",
                "ar" => "غير ذالك"
            ],
        
        ];

           foreach($genders as $gender){
            Gender::create(['name'=>$gender]);
           }
    }
}
