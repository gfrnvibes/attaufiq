<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $gurus = [
            ['name' => 'SOFWAN MUNAWAR, S.Pd.I'],
            ['name' => 'ENUR HASANUKRI, S.Pd.I'],
            ['name' => 'DIMAN HIDAYAT, S.Pd.'],
            ['name' => 'DODI RAHMAN, S.Pd.I'],
            ['name' => 'DEDE SITI WAHIDAH, S.Pd.'],
            ['name' => 'YANI SUMARNI, S.Ag.'],
            ['name' => 'DRA. SITI KAMILAH'],
            ['name' => 'AHMAD WAHIDIN, S.Pd.'],
            ['name' => 'IRMA NURMALASARI, S.Pd.'],
            ['name' => 'ABDUL WAHAB, S.Pd.'],
            ['name' => 'EVI ALFIKIN, S.Pd.'],
            ['name' => 'UST. AKOH BAROKAH'],
            ['name' => 'MU’MIN MUSTAWAN JAMIL, S.Pd.I'],
        ];

        foreach ($gurus as &$g) {
            $g += [
                'nip' => null,
                'nuptk' => null,
                'email' => null,
                'phone' => null,
                'jabatan' => 'guru',
                'created_at' => $now,
                'updated_at' => $now
            ];
        }
        DB::table('gurus')->insert($gurus);
    }
}
