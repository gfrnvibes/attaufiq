<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Province::updateOrCreate(
            ['id' => 32], // search by ID
            ['name' => 'Jawa Barat'] // values to update
        );
    }

}
