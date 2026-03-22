<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Chama os teus novos seeders pela ordem correta
        $this->call([
            EstudioSeeder::class,
            FilmeSeeder::class,
        ]);
    }
}
