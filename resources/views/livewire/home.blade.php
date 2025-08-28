<div>
    {{-- Hero Section --}}
    <section class="p-5 text-center mt-2 mt-md-5">
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

    {{-- Statistik Section --}}
    <div class="container p-3 p-md-5">
        <div class="row g-3">
            <div class="col-xl-3 col-sm-6 col-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h3 class="danger">278</h3>
                                    <span>New Projects</span>
                                </div>
                                <div class="align-self-center">
                                    <i class="icon-rocket danger font-large-2 float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h3 class="success">156</h3>
                                    <span>New Clients</span>
                                </div>
                                <div class="align-self-center">
                                    <i class="icon-user success font-large-2 float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h3 class="warning">64.89 %</h3>
                                    <span>Conversion Rate</span>
                                </div>
                                <div class="align-self-center">
                                    <i class="icon-pie-chart warning font-large-2 float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h3 class="primary">423</h3>
                                    <span>Support Tickets</span>
                                </div>
                                <div class="align-self-center">
                                    <i class="icon-support primary font-large-2 float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Sambutan Kepala Madrasah --}}
    <div class="container-fluid" style="background-color: #f8f9fa;">
        <div class="container p-5">
            <div class="row gap-4 justify-content-center">
                <div class="col-12 col-md-5">
                    <img src="https://img.freepik.com/free-vector/flat-design-after-school-webinar-template_23-2149558587.jpg?ga=GA1.1.255730098.1756364458&semt=ais_hybrid&w=740&q=80"
                        alt="" class="img-fluid">
                </div>
                <div class="col-12 col-md-5">
                    <h2 class="special-font text-success mb-4">Sambutan Kepala Madrasah</h2>
                    <p>"{{ $webSetting->sambutan_kepsek }}"</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Visi Misi Section --}}
    <div class="container-fluid p-5">
        <div class="p-1 p-md-6 mb-md-5">
            <div class="row gap-4 justify-content-center align-items-center">
                <div class="col-12 col-md-5 mb-3 mb-md-5">
                    <img src="https://img.freepik.com/free-psd/back-school-web-banner-background-template_120329-6277.jpg?t=st=1756364479~exp=1756368079~hmac=cd6452b1ce256ac07392489e4bb56900e28a8aa0524398f3b209e63881da2916&w=1480"
                        alt="" class="img-fluid">
                </div>
                <div class="col-12 col-md-5  mb-5 mb-md-0">
                    <h2 class="special-font text-success">Visi Kami ✨</h2>
                    <p class="lead">{{ $webSetting->visi }}</p>
                </div>
            </div>
        </div>

        <div class="p-1 p-md-3">
            <div class="row gap-3 justify-content-center align-items-center flex-wrap-reverse">
                <div class="col-12 col-md-5 mb-3 ">
                    <h2 class="special-font text-success">Misi Kami 🚀</h2>
                    <ol>
                        @foreach ($webSetting->misi as $key => $misi)
                            <li class="text-justify">{{ $misi }}</li>
                        @endforeach
                    </ol>
                </div>
                <div class="col-12 col-md-5 mb-5 mb-md-0 ">
                    <img src="https://img.freepik.com/free-psd/back-school-web-banner-background-template_120329-6277.jpg?t=st=1756364479~exp=1756368079~hmac=cd6452b1ce256ac07392489e4bb56900e28a8aa0524398f3b209e63881da2916&w=1480"
                        alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    {{-- Galeri Section --}}
        <div class="photo-gallery">
            <div class="container">
                <div class="intro">
                    <h2 class="text-center">Lightbox Gallery</h2>
                    <p class="text-center">Nunc luctus in metus eget fringilla. Aliquam sed justo ligula. Vestibulum nibh erat,
                        pellentesque ut laoreet vitae. </p>
                </div>
                <div class="row photos">
                    <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="assets/img/desk.jpg" data-lightbox="photos"><img
                                class="img-fluid" src="https://img.freepik.com/free-psd/back-school-web-banner-background-template_120329-6277.jpg?t=st=1756364479~exp=1756368079~hmac=cd6452b1ce256ac07392489e4bb56900e28a8aa0524398f3b209e63881da2916&w=1480"></a></div>
                    <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="assets/img/building.jpg" data-lightbox="photos"><img
                                class="img-fluid" src="https://img.freepik.com/free-psd/back-school-web-banner-background-template_120329-6277.jpg?t=st=1756364479~exp=1756368079~hmac=cd6452b1ce256ac07392489e4bb56900e28a8aa0524398f3b209e63881da2916&w=1480"></a></div>
                    <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="assets/img/loft.jpg" data-lightbox="photos"><img
                                class="img-fluid" src="https://img.freepik.com/free-psd/back-school-web-banner-background-template_120329-6277.jpg?t=st=1756364479~exp=1756368079~hmac=cd6452b1ce256ac07392489e4bb56900e28a8aa0524398f3b209e63881da2916&w=1480"></a></div>
                </div>
            </div>
        </div>

    {{-- CTA Section --}}
    <section class="my-lg-14 mb-8">
        <!-- container -->
        <div class="container bg-primary rounded-3">
            <!-- row -->
            <div class="row align-items-center">
                <!-- col -->
                <div class="col-lg-6 col-12 d-none d-lg-block">
                    <div class="d-flex justify-content-center ">
                        <!-- img -->
                        <div class="position-relative">
                            <img src="../assets/images/png/cta-instructor-1.png" alt=""
                                class="img-fluid mt-n13">
                            <div class="ms-n12 position-absolute bottom-0 start-0 mb-6">
                                <img src="../assets/images/svg/dollor.svg" alt="">
                            </div>
                            <!-- img -->
                            <div class="me-n4 position-absolute top-0 end-0">
                                <img src="../assets/images/svg/graph.svg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-12">
                    <div class="text-white p-5 p-xl-0">
                        <!-- text -->
                        <h2 class="h1 text-white">Become an instructor today</h2>
                        <p class="mb-0">Instructors from around the world teach millions of students on Geeks. We
                            provide the tools
                            and skills to teach what you love.</p>
                        <a href="#" class="btn btn-white mt-4">Start Teaching Today</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Kontak Kami --}}

</div>
