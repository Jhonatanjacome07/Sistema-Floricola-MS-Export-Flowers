<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Flowers;
use App\Models\Plagas;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this-> call (UserSeeder::class);

        Flowers:: factory()->count (10)->create();
        Plagas:: factory()->count (10)->create();
    }
}
