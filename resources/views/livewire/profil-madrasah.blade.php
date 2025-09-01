<div>
    <div class="mt-5 mb-4">
        <h1 class="text-center text-gradient fw-bold display-4">Profil MTs At-Taufiq</h1>
    </div>
    <div class="text-center">
        <a class="btn btn-outline-success btn-sm rounded-pill" href="#sejarah">Sejarah Madrasah</a>
        <a class="btn btn-outline-success btn-sm rounded-pill" href="#visi">Visi & Misi</a>
        <a class="btn btn-outline-success btn-sm rounded-pill" href="#struktur">Struktur Organisasi</a>
        <a class="btn btn-outline-success btn-sm rounded-pill" href="#guru">Guru & Tenaga Kependidikan</a>
        <a class="btn btn-outline-success btn-sm rounded-pill" href="#sarana">Sarana & Prasarana</a>
    </div>

    {{-- Sejarah Madrasah --}}
    <div class="container p-5" id="sejarah">
        <h3 class="text-center special-font text-success mb-5">At-Taufiq tuh punya sejarah kayak gimana, ya?</h3>
        <div class="row justify-content-center align-items-center">
            <div class="col">
                <img src="https://placehold.co/400x200" alt="" class="img-fluid">
            </div>
            <div class="col-12 col-md-6">
                <p class="text-justify">{{ $profil->sejarah }}</p>
            </div>
        </div>
    </div>

    {{-- Visi & Misi --}}
    <div class="container p-5" id="visi">
        <h3 class="text-center special-font text-success mb-5">Arah & Tujuan Kita</h3>
        <div class="row">
            <div class="col-12 col-md-6 text-center">
                <h4>Visi</h4>
                <p class="">"{{ $profil->visi }}"</p>
            </div>
            <div class="col-12 col-md-6">
                <h4 class="text-center">Misi</h4>
                <ol>
                    @foreach ($profil->misi as $key => $misi)
                       <li class="text-justify">{{ $misi['misi_item'] }}</li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
    
    {{-- Struktur Organisasi --}}
    <div class="container p-5" id="struktur">
        <h3 class="text-center special-font text-success mb-5">Struktur Organisasi</h3>
        <div class="d-flex justify-content-center">
            <img src="https://placehold.co/800x400" alt="" class="img-fluid">
        </div>
    </div>

    {{-- Guru & Tenaga Kependidikan --}}
    <div class="container p-5" id="guru">
        <h3 class="text-center special-font text-success mb-5">Para Pahlawan At-Taufiq</h3>        
        <div class="row g-3">
            @forelse($gurus as $guru)
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100">
                        @php
                            $avatarUrl = $guru->getFirstMediaUrl('avatar');
                            $previewUrl = $guru->getFirstMediaUrl('avatar', 'preview');
                        @endphp
                        
                        @if($avatarUrl)
                            <img src="{{ $previewUrl ?: $avatarUrl }}" alt="{{ $guru->name }}" class="card-img-top" style="height: 300px; object-fit: cover;">
                        @else
                            <div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height: 300px;">
                                <i class="fas fa-user fa-5x text-muted"></i>
                            </div>
                        @endif
                        
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $guru->name }}</h5>
                            @if($guru->jabatan)
                                <p class="card-text text-muted text-capitalize">{{ $guru->jabatan }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada data guru yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Sarana & Prasarana --}}
    <div class="container p-5" id="sarana">
        <h3 class="text-center special-font text-success mb-5">Fasilitas Asik Buat Belajar</h3>
        @if($fasilitas->count() > 0)
            <div class="row g-4">
                @foreach($fasilitas as $item)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100">
                            @php
                                $gambarUrl = $item->getFirstMediaUrl('gambar');
                                $previewUrl = $item->getFirstMediaUrl('gambar', 'preview');
                            @endphp
                            
                            @if($gambarUrl)
                                <img src="{{ $previewUrl ?: $gambarUrl }}" alt="{{ $item->nama_fasilitas }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                                    <i class="fas fa-building fa-3x text-muted"></i>
                                </div>
                            @endif
                            
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->nama_fasilitas }}</h5>
                                @if($item->deskripsi_fasilitas)
                                    <p class="card-text">{{ $item->deskripsi_fasilitas }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="d-flex gap-3 justify-content-center">
                <img src="https://placehold.co/300x300" alt="" class="img-fluid">
                <img src="https://placehold.co/300x300" alt="" class="img-fluid">
                <img src="https://placehold.co/300x300" alt="" class="img-fluid">
                <img src="https://placehold.co/300x300" alt="" class="img-fluid">
            </div>
            <div class="text-center mt-3">
                <p class="text-muted">Belum ada data fasilitas yang tersedia.</p>
            </div>
        @endif
    </div>
</div>