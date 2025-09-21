<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    DB::table('users')->delete();
       $user = User::create([
        'name'=>'ahmed gaber',
        'email'=>'ahmed799@gmail.com',
        'password'=>Hash::make('12344321'),
       ]);

       $user = User::create([
        'name'=>'abo azoz',
        'email'=>'a@a.com',
        'password'=>Hash::make('12344321'),
       ]);

    }
}
