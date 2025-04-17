<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Address;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ConfigSeeder::class,
            
            TemplateSeeder::class,
            CompanySeeder::class,
            AddressSeeder::class,
            TripSeeder::class,            
            ManifestSeeder::class,
            ManifestItemSeeder::class,            
        ]);
    }
}
