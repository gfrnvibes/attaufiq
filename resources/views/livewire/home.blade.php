<div>
    {{-- Hero Section --}}
    <section class="p-5 text-center mt-2 mt-md-5">
        <h3 class="special-font ml7">Hai, kamu sedang berada di</h3>
        <h1 class="text-gradient fw-bold display-1">{{ $profilSekolah->name ?? 'Website Sekolah SMP/Sederajat' }}</h1>
        <div class="col-12 col-md-6 mx-auto mb-4">
            <p class="lead">
                {{ $profilSekolah->description ?? 'Website Sistem Informasi Sekolah ini dikembangkan oleh Gufron untuk membantu sekolah-sekolah di Indonesia yang belum memiliki website. Dilengkapi dengan fitur PPDB online dan informasi profil sekolah, website ini hadir sebagai sarana promosi sekaligus media layanan digital bagi sekolah.' }}
            </p>
        </div>
        <div class="d-flex gap-2 justify-content-center">
            <a href="{{ route('ppdb') }}" class="btn btn-md-lg btn-success rounded-pill fw-bold">
                <i class="fa-solid fa-arrow-up-right-from-square me-2"></i>Pendaftaran
            </a>
            <a href="#galeri" class="btn btn-md-lg btn-outline-success rounded-pill fw-bold">
                <i class="fa-solid fa-images me-2"></i>Galeri
            </a>
        </div>
    </section>

    {{-- Statistik Section --}}
    <div class="container p-3 p-md-5">
        <div class="row">
            @foreach ($profilSekolah->static as $item)
                <div class="col-xl-3 col-sm-6 col-6">
                    <div class="card rounded-4 border-0 shadow-sm">
                        <div class="card-content">
                            <div class="card-body px-4">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="text-success fw-semibold">{{ $item['jumlah'] }}</h3>
                                        <span>{{ ucfirst($item['nama']) }}</span>
                                    </div>
                                    <div class="align-self-center">
                                        @if ($item['nama'] === 'siswa')
                                            <i class="icon-briefcase success font-large-2 float-right"></i>
                                        @elseif($item['nama'] === 'guru')
                                            <i class="icon-briefcase success font-large-2 float-right"></i>
                                        @elseif($item['nama'] === 'alumni')
                                            <i class="icon-graduation warning font-large-2 float-right"></i>
                                        @elseif($item['nama'] === 'kelas')
                                            <i class="icon-home danger font-large-2 float-right"></i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    {{-- Sambutan Kepala Madrasah --}}
    <div class="container-fluid" style="background-color: #f8f9fa;">
        <div class="container p-5">
            <div class="text-center mb-5">
                <h1 class="special-font text-success mb-4">Sambutan Kepala Sekolah</h1>
                <p class="lead">
                    "{{ $profilSekolah->sambutan_kepsek }}"
                </p>
            </div>
            <div class="col-6 mx-auto">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="col">
                        <img src="" alt="kepala sekolah">
                    </div>
                    <div class="col">
                        <h4>Nama Kepala Sekolah</h4>
                        <p>Kepala Sekolah</p>
                    </div>  
                </div>
            </div>
        </div>
    </div>

    {{-- Visi Misi Section --}}
    <div class="container-fluid p-5">
        <div class="container p-1 p-md-6 mb-5">
            <h1 class="special-font text-success text-center mb-4">Visi Kami ✨</h1>
            <h3 class="text-center">
                {{ $profilSekolah->visi ?? 'Menjadi pengembang solusi digital pendidikan yang mampu menghadirkan website sekolah modern, mudah digunakan, dan bermanfaat sebagai sarana promosi, layanan, serta peningkatan mutu pendidikan di era digital.' }}
            </h3>
        </div>

        <div class="container p-1 p-md-3">
            <div class="row gap-3 justify-content-center align-items-start">
                <div class="col-12">
                    <h1 class="special-font text-success text-center">Misi Kami 🚀</h1>
                </div>

                @if ($profilSekolah)
                    <div class="row row-cols-1 row-cols-md-2 g-3">
                        @foreach ($profilSekolah->misi as $key => $misi)
                            <div class="col">
                                <div class="card h-100 shadow-sm border-0">
                                    <div class="card-body">
                                        <p class="lead mb-0 fw-semibold">{{ $misi['misi_item'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="row row-cols-1 row-cols-md-2 g-3">
                        <div class="col">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body">
                                    <p class="lead mb-0">Membantu sekolah-sekolah di Indonesia memiliki website resmi
                                        yang informatif
                                        dan representatif.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body">
                                    <p class="lead mb-0">Menyediakan fitur-fitur penting seperti PPDB online, profil
                                        sekolah, dan
                                        informasi akademik secara terintegrasi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body">
                                    <p class="lead mb-0">Menghadirkan desain modern, responsif, dan ramah pengguna agar
                                        mudah diakses
                                        oleh semua kalangan.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body">
                                    <p class="lead mb-0">Mendukung sekolah dalam membangun citra digital yang positif
                                        dan profesional.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body">
                                    <p class="lead mb-0">Terus mengembangkan sistem agar relevan dengan kebutuhan
                                        pendidikan di era
                                        teknologi yang terus berkembang.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>

    {{-- Galeri Section --}}
    <div class="container-fluid mb-5">
        <div class="container">
            <div>
                <h1 id="galeri" class="special-font text-success text-center mb-3">Kegiatan Kami</h1>
                <p class="text-center lead mb-3">Kumpulan foto kegiatan di {{ $profilSekolah->web_name }}</p>
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <img src="https://img.freepik.com/free-psd/back-school-web-banner-background-template_120329-6277.jpg?t=st=1756364479~exp=1756368079~hmac=cd6452b1ce256ac07392489e4bb56900e28a8aa0524398f3b209e63881da2916&w=1480"
                        alt="" class="img-fluid">
                </div>
                <div class="col-12 col-md-4">
                    <img src="https://img.freepik.com/free-psd/back-school-web-banner-background-template_120329-6277.jpg?t=st=1756364479~exp=1756368079~hmac=cd6452b1ce256ac07392489e4bb56900e28a8aa0524398f3b209e63881da2916&w=1480"
                        alt="" class="img-fluid">
                </div>
                <div class="col-12 col-md-4">
                    <img src="https://img.freepik.com/free-psd/back-school-web-banner-background-template_120329-6277.jpg?t=st=1756364479~exp=1756368079~hmac=cd6452b1ce256ac07392489e4bb56900e28a8aa0524398f3b209e63881da2916&w=1480"
                        alt="" class="img-fluid">
                </div>
            </div>
            <div class="text-center mx-auto mt-3">
                <a href="" class="btn btn-outline-success rounded-pill fw-bold">📸 Lihat Semua</a>
            </div>
        </div>
    </div>

    {{-- CTA Section --}}
    <section class="container-fluid mb-5">
        <!-- container -->
        <div class="container p-5 bg-success rounded-4 mx-auto text-center">
            <div class="text-white p-5 p-xl-0">
                <!-- text -->
                <h2 class="h1 text-white">Ayo Daftar Sekarang!</h2>
                <p class="mb-0">Pendaftaran Gratis dan Tidak Dipungut Biaya.</p>
                <a href="{{ route('ppdb') }}" class="btn btn-warning rounded-pill fw-bold mt-4">Daftar Peserta Didik
                    Baru</a>
            </div>
        </div>
    </section>

    {{-- Kontak Kami --}}

</div>
