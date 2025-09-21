<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\DB;
use App\Models\Religions;


class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('religions')->delete();

        $reiligion = [
            [
               
                'en'=>'muslim',
                'ar'=>'مسلم',
            ],
            [
                'en'=>'chrisitan',
                'ar'=>'مسيحي',
            ],
            [
                'en'=>'other',
                'ar'=>'غير ذالك',
            ],

        ];

        foreach($reiligion as $reiligions){
            Religions::create(['name'=>$reiligions]);
        }
    }
}
