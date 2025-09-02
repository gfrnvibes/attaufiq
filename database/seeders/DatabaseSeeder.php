<?php

namespace Database\Seeders;

use App\Models\ProfilSekolah;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // DB::unprepared(file_get_contents((database_path('seeders/indonesia.sql'))));

        User::updateOrCreate(
            ['email' => 'admin@attaufiq.com'], 
            [
                'name' => 'Administrator',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), 
                'remember_token' => Str::random(10),
            ]
        );

        $this->call([
            ProfilSekolahSeeder::class,
            ProvinceSeeder::class,
            RegencySeeder::class,
            DistrictSeeder::class,
            VillageSeeder::class,
            MataPelajaranSeeder::class,
            GuruSeeder::class,
            GuruMataPelajaranSeeder::class,
        ]);
    }
}
