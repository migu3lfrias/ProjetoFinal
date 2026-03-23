<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@cinecrm.pt'],
            [
                'name'      => 'Admin',
                'password'  => Hash::make('password'),
                'user_type' => 1,
            ]
        );

        User::firstOrCreate(
            ['email' => 'teste@cinecrm.pt'],
            [
                'name'      => 'Teste',
                'password'  => Hash::make('password'),
                'user_type' => 0,
            ]
        );
    }
}
