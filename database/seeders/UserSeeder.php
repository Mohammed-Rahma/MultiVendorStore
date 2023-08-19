<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
          'name' => 'mohamedH',
          'email' => 'eng@company.org',
          'password'=>Hash::make('password'),
          'phone_number'=>'0592168641'
        ]);

        DB::table('users')->insert([
            'name' => 'Ahmd',
            'email' => 'eAD@company.org',
            'password'=>Hash::make('password'),
            'phone_number'=>'05999000044'
        ]);
    }
}
