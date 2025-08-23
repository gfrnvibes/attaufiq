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
                <p class="text-justify">{{ $webSetting->sejarah }}</p>
            </div>
        </div>
    </div>

    {{-- Visi & Misi --}}
    <div class="container p-5" id="visi">
        <h3 class="text-center special-font text-success mb-5">Arah & Tujuan Kita</h3>
        <div class="row">
            <div class="col-12 col-md-6 text-center">
                <h4>Visi</h4>
                <p class="">"{{ $webSetting->visi }}"</p>
            </div>
            <div class="col-12 col-md-6">
                <h4 class="text-center">Misi</h4>
                <ol>
                    @foreach ($webSetting->misi as $key => $misi)
                       <li class="text-justify">{{ $misi }}</li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
    
    {{-- Struktur Organisasi --}}
    <div class="container p-5" id="struktur">
        <h3 class="text-center special-font text-success mb-5">Orang-Orang Keren di At-Taufiq</h3>
        <div class="d-flex justify-content-center">
            <img src="https://placehold.co/800x400" alt="" class="img-fluid">
        </div>
    </div>

    {{-- Guru & Tenaga Kependidikan --}}
    <div class="container p-5" id="guru">
        <h3 class="text-center special-font text-success mb-5">Para Pahlawan At-Taufiq</h3>        
        <div class="d-flex gap-3">
            <img src="https://placehold.co/300x300" alt="" class="img-fluid">
            <img src="https://placehold.co/300x300" alt="" class="img-fluid">
            <img src="https://placehold.co/300x300" alt="" class="img-fluid">
            <img src="https://placehold.co/300x300" alt="" class="img-fluid">
        </div>
    </div>

    {{-- Sarana & Prasarana --}}
    <div class="container p-5" id="sarana">
        <h3 class="text-center special-font text-success mb-5">Fasilitas Asik Buat Belajar</h3>
        <div class="d-flex gap-3">
            <img src="https://placehold.co/300x300" alt="" class="img-fluid">
            <img src="https://placehold.co/300x300" alt="" class="img-fluid">
            <img src="https://placehold.co/300x300" alt="" class="img-fluid">
            <img src="https://placehold.co/300x300" alt="" class="img-fluid">
        </div>
    </div>
</div>