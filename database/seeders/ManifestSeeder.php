<?php

namespace Database\Seeders;

use App\Models\Manifest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManifestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Manifest::factory()->count(200)->create();
    }
}
