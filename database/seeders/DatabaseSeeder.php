<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@attaufiq.com'], // kunci unik
            [
                'name' => 'Administrator',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // jangan lupa ganti di production!
                'remember_token' => Str::random(10),
            ]
        );

        $this->call([
            MataPelajaranSeeder::class,
            GuruSeeder::class,
            GuruMataPelajaranSeeder::class,
        ]);
    }
}
