<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\MahasiswaSeeder; // Tambahkan ini

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            MahasiswaSeeder::class,
        ]);
    }
}
