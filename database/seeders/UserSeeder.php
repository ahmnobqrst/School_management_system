<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();

        // Super Admin 1
        User::create([
            'name' => [
                'ar' => 'أحمد جابر',
                'en' => 'Ahmed Gaber',
            ],
            'email' => 'ahmedazoz799@gmail.com',
            'password' => Hash::make('12344321'),
        ]);

        // Super Admin 2
        User::create([
            'name' => [
                'ar' => 'محمود جابر',
                'en' => 'Mahmoud Gaber',
            ],
            'email' => 'mahmoudgaber123@gmail.com',
            'password' => Hash::make('12344321'),
        ]);

        // Super Admin 3
        User::create([
            'name' => [
                'ar' => 'علاء جمال',
                'en' => 'alaa gamal',
            ],
            'email' => 'alaagamal123@gmail.com',
            'password' => Hash::make('12344321'),
        ]);
    }
}
