<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'test',
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => Hash::make('KRg29Hr2R3y1QaEyzHoSqH8fR'),
        ]);

        User::create([
            'username' => 'Kendra',
            'name' => 'Kendra',
            'email' => 'kendra@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'username' => 'Beti',
            'name' => 'Beti',
            'email' => 'beti@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'username' => 'Minsc',
            'name' => 'Minsc',
            'email' => 'minsc@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
