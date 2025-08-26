<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Regency::updateOrCreate(
            ['id' => '3205'], // search by ID
            ['province_id' => '32', 'name' => 'Kabupaten Garut'] // values to update/insert
        );
    }

}
