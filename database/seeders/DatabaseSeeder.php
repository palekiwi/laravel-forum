<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'test',
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => Hash::make('KRg29Hr2R3y1QaEyzHoSqH8fR'),
        ]);
    }
}
