<?php

namespace Database\Seeders;

use App\Models\ManifestItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManifestItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ManifestItem::factory()->count(50)->create();
    }
}
