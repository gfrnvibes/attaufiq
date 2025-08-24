<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GuruMataPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // ambil id by name
        $mapelIds = DB::table('mata_pelajarans')->pluck('id', 'nama_mapel');
        $guruIds = DB::table('gurus')->pluck('id', 'name');

        // mapping 1–1 (bisa ditambah mudah nanti)
        $pairs = [
            "SOFWAN MUNAWAR, S.Pd.I" => "Al-Qur'an Hadis",
            "ENUR HASANUKRI, S.Pd.I" => "Aqidah Akhlak",
            "DIMAN HIDAYAT, S.Pd." => "Matematika",
            "DODI RAHMAN, S.Pd.I" => "Fikih",
            "DEDE SITI WAHIDAH, S.Pd." => "Bahasa Indonesia",
            "YANI SUMARNI, S.Ag." => "Bahasa Arab",
            "DRA. SITI KAMILAH" => "Ilmu Pengetahuan Sosial (IPS)",
            "AHMAD WAHIDIN, S.Pd." => "Ilmu Pengetahuan Alam (IPA)",
            "IRMA NURMALASARI, S.Pd." => "Bahasa Inggris",
            "ABDUL WAHAB, S.Pd." => "PJOK",
            "EVI ALFIKIN, S.Pd." => "Seni Budaya",
            "UST. AKOH BAROKAH" => "Sejarah Kebudayaan Islam (SKI)",
            "MU’MIN MUSTAWAN JAMIL, S.Pd.I" => "Pendidikan Pancasila (PPKn)",
        ];

        $rows = [];
        foreach ($pairs as $guruName => $mapelName) {
            if (isset($guruIds[$guruName], $mapelIds[$mapelName])) {
                $rows[] = [
                    'guru_id' => $guruIds[$guruName],
                    'mata_pelajaran_id' => $mapelIds[$mapelName],
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        DB::table('guru_mata_pelajarans')->insert($rows);
    }
}
