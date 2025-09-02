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
                'description' => 'Website resmi MTs At-Taufiq Cisurupan sebagai pusat informasi, layanan akademik, publikasi prestasi madrasah, dan media untuk memperkenalkan program serta kegiatan unggulan kepada masyarakat.',
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
                'sejarah' => "MTs AT-TAUFIQ, sebuah lembaga pendidikan swasta di bawah naungan Kementerian Agama, berdiri tegak di Kp. Dungus Maung Rt 04/05, Desa SIRNAGALIH, Kecamatan CISURUPAN, Kabupaten GARUT, Jawa Barat. Sekolah ini memiliki peran penting dalam mencetak generasi muda yang berkualitas di wilayah tersebut.\n

                MTs AT-TAUFIQ didirikan pada tanggal 24 April 2010 berdasarkan Surat Keputusan Nomor Kw.10.4/4/PP.00.5/3019/2010 dan memiliki Nomor SK Operasional D/Kw.10/MTs/1573/2010 yang diterbitkan pada tanggal yang sama. Sekolah ini telah terakreditasi dengan nilai C berdasarkan Surat Keputusan Nomor 02.00/111/BAP-SM/SK/X/2015 yang diterbitkan pada tanggal 13 Oktober 2015.",
                'social' => [
                    ['nama' => 'telepon', 'link' => 'tel:+6281234567890'],
                    ['nama' => 'email', 'link' => 'mailto:info@mtsattaufiq.com'],
                    ['nama' => 'facebook', 'link' => 'https://www.facebook.com/mtsattaufiq'],
                    ['nama' => 'instagram', 'link' => 'https://www.instagram.com/mtsattaufiq'],
                ],
                'static' => [
                    ['nama' => 'siswa', 'jumlah' => 1200],
                    ['nama' => 'alumni', 'jumlah' => 1000],
                    ['nama' => 'guru', 'jumlah' => 75],
                    ['nama' => 'kelas', 'jumlah' => 30],
                ],
            ]
        );
    }
}