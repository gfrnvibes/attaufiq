<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MataPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $mapels = [
            ["nama_mapel" => "Al-Qur'an Hadis", "deskripsi_mapel" => 'Kajian tilawah & hadis.'],
            ['nama_mapel' => 'Aqidah Akhlak', 'deskripsi_mapel' => 'Keimanan & karakter.'],
            ['nama_mapel' => 'Fikih', 'deskripsi_mapel' => 'Ibadah & muamalah.'],
            ['nama_mapel' => 'Sejarah Kebudayaan Islam (SKI)', 'deskripsi_mapel' => 'Peradaban Islam.'],
            ['nama_mapel' => 'Bahasa Arab', 'deskripsi_mapel' => 'Istima’, kalam, qiro’ah, kitabah.'],
            ['nama_mapel' => 'Pendidikan Pancasila (PPKn)', 'deskripsi_mapel' => 'Kewarganegaraan.'],
            ['nama_mapel' => 'Bahasa Indonesia', 'deskripsi_mapel' => 'Literasi & tata bahasa.'],
            ['nama_mapel' => 'Matematika', 'deskripsi_mapel' => 'Aritmetika–aljabar–geometri.'],
            ['nama_mapel' => 'Ilmu Pengetahuan Alam (IPA)', 'deskripsi_mapel' => 'Fisika & biologi dasar.'],
            ['nama_mapel' => 'Ilmu Pengetahuan Sosial (IPS)', 'deskripsi_mapel' => 'Geo–eko–sos–sejarah.'],
            ['nama_mapel' => 'Bahasa Inggris', 'deskripsi_mapel' => 'LSRW.'],
            ['nama_mapel' => 'Seni Budaya', 'deskripsi_mapel' => 'Rupa, musik, tari, teater.'],
            ['nama_mapel' => 'PJOK', 'deskripsi_mapel' => 'Olahraga & kesehatan.'],
        ];
        foreach ($mapels as &$m)
            $m += ['created_at' => $now, 'updated_at' => $now];
        DB::table('mata_pelajarans')->insert($mapels);
    }
}
