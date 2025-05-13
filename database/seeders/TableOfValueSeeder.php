<?php

namespace Database\Seeders;

use App\Models\TableOfValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableOfValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
    */
    public function run(): void
    {
        TableOfValue::factory()->count(1)->create();
    }
}
