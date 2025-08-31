<?php

namespace Database\Seeders;

use App\Models\ProfilSekolah;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProfilSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfilSekolah::updateOrCreate(
            ['id' => 1], // Kunci unik (kolom unique di migrasi)
            [
                'name' => 'MTs At-Taufiq Cisurupan',
                'address' => 'Jl. Raya Cisurupan No. 123, Cisurupan, Garut, Jawa Barat',
                'tagline' => 'Madrasah Hebat Bermartabat',
                'description' => 'Website resmi MTs At-Taufiq Cisurupan sebagai pusat informasi, layanan akademik, dan publikasi prestasi madrasah.',
                'sambutan_kepsek' => "Assalamu’alaikum warahmatullahi wabarakatuh.\nSelamat datang di portal resmi MTs At-Taufiq Cisurupan. Semoga laman ini menjadi jembatan informasi dan kolaborasi antara madrasah, peserta didik, orang tua, dan masyarakat. Wassalamu’alaikum warahmatullahi wabarakatuh.",
                'visi' => 'Menjadi madrasah unggul dalam iman, ilmu, dan akhlak mulia yang mampu melahirkan generasi berkarakter Islami, cerdas, kreatif, berdaya saing global, serta adaptif terhadap perkembangan ilmu pengetahuan dan teknologi di era digital.',
                'misi' => [
                    ['misi_item' => 'Menumbuhkan akhlak karimah melalui pembiasaan ibadah dan budaya positif.'],
                    ['misi_item' => 'Meningkatkan literasi sains, teknologi, dan informasi (STI) secara berkelanjutan.'],
                    ['misi_item' => 'Menciptakan lingkungan belajar yang aman, inklusif, dan ramah anak.'],
                    ['misi_item' => 'Mendorong prestasi akademik dan non-akademik di tingkat daerah hingga nasional.'],
                    ['misi_item' => 'Memperkuat kolaborasi dengan orang tua dan masyarakat.'],
                    ['misi_item' => 'Meningkatkan partisipasi akademik dan non-akademik di tingkat daerah hingga nasional.'],
                ],
                'sejarah' => "MTs At-Taufiq Cisurupan berdiri pada tahun 2008. Sejak awal, fokus pada pembinaan karakter dan prestasi. Kini berkembang sebagai madrasah rujukan dengan integrasi teknologi pembelajaran modern.",
                'social' => [
                    ['nama' => 'telepon', 'link' => 'tel:+6281234567890'],
                    ['nama' => 'email', 'link' => 'mailto:info@mtsattaufiq.com'],
                    ['nama' => 'facebook', 'link' => 'https://www.facebook.com/mtsattaufiq'],
                    ['nama' => 'instagram', 'link' => 'https://www.instagram.com/mtsattaufiq'],
                ],
                'static' => [
                    ['nama' => 'siswa', 'jumlah' => 1200],
                    ['nama' => 'alumni', 'jumlah' => 800],
                    ['nama' => 'guru', 'jumlah' => 75],
                    ['nama' => 'kelas', 'jumlah' => 30],
                    ['nama' => 'ruang', 'jumlah' => 150],
                ],
            ]
        );
    }
}