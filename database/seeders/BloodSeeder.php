<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\BloodType;

class BloodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           DB::table('blood_type')->delete(); //ده علشان لما اجي انفذ ال seeder مرة تانية يحذف الاول ويضبف من جديد
           $bloodtype = ['A+','A-','B+','B-','AB+','AB-','O-','O+'];

           foreach($bloodtype as $bloodtypes){
            BloodType::create(['name'=>$bloodtypes]);
           }
            
       
    }
}
