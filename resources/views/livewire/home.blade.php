<div>
    <section class="p-5 text-center mt-5">
        <h3 class="special-font ml7">Hai, kamu sedang berada di</h3>
        <h1 class="text-gradient fw-bold display-1">{{ $webSetting->web_name }}</h1>
        <div class="col-12 col-md-6 mx-auto mb-4">
            <p class="lead">{{ $webSetting->web_description }}
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

    <div class="container-fluid p-5 mt-5">
        <div class="container p-1 p-md-6 mb-md-5">
            <div class="row justify-content-center align-items-center ">
                <div class="col-12 col-md-6 mb-3 mb-md-5">
                    <img src="{{ asset('assets/img/undraw_math_ldpv.svg') }}" alt="" class="img-fluid"
                        width="60%">
                </div>
                <div class="col-12 col-md-6  mb-5 mb-md-0">
                    <h2 class="special-font text-success">Visi Kami ✨</h2>
                    <p class="lead">{{ $webSetting->visi }}</p>
                </div>
            </div>
        </div>

        <div class="container p-1 p-md-3">
            <div class="row justify-content-center align-items-center flex-wrap-reverse ">
                <div class="col-12 col-md-6 mb-3 ">
                    <h2 class="special-font text-success">Misi Kami 🚀</h2>
                                    <ol>
                                        @foreach ($webSetting->misi as $key => $misi)
                                            <li class="text-justify">{{ $misi }}</li>
                                        @endforeach
                                    </ol>
                </div>
                <div class="col-12 col-md-6 mb-5 mb-md-0 ">
                    <img src="{{ asset('assets/img/undraw_graduation_u7uc.svg') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <div id="galeri" class="p-5">
        <div>
            <h2 class="text-center special-font text-success">Kegiatan Kami</h2>
        </div>
    </div>
</div>
