<?php

namespace Database\Seeders;

use App\Models\WebSetting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WebSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebSetting::updateOrCreate(
            // Kunci unik (kolom unique di migrasi)
            ['web_name' => 'MTs At-Taufiq Cisurupan'],

            // Payload data
            [
                'web_tagline' => 'Madrasah Hebat Bermartabat',
                'web_description' => 'Website resmi MTs At-Taufiq Cisurupan sebagai pusat informasi, layanan akademik, dan publikasi prestasi madrasah.',
                'sambutan_kepsek' => "Assalamu’alaikum warahmatullahi wabarakatuh.\nSelamat datang di portal resmi MTsN 1 Kota Contoh. Semoga laman ini menjadi jembatan informasi dan kolaborasi antara madrasah, peserta didik, orang tua, dan masyarakat. Wassalamu’alaikum warahmatullahi wabarakatuh.",
                'visi' => 'Menjadi madrasah unggul dalam iman, ilmu, dan akhlak mulia di era digital.',
                'misi' => [
                    'Menumbuhkan akhlak karimah melalui pembiasaan ibadah dan budaya positif.',
                    'Meningkatkan literasi sains, teknologi, dan informasi (STI) secara berkelanjutan.',
                    'Menciptakan lingkungan belajar yang aman, inklusif, dan ramah anak.',
                    'Mendorong prestasi akademik dan non-akademik di tingkat daerah hingga nasional.',
                    'Memperkuat kolaborasi dengan orang tua dan masyarakat.',
                ],
                'sejarah' => "MTsN 1 Kota Contoh berdiri pada tahun 1998. Sejak awal, fokus pada pembinaan karakter dan prestasi. Kini berkembang sebagai madrasah rujukan dengan integrasi teknologi pembelajaran modern.",
            ]
        );
    }
}
