<nav class="navbar navbar-expand-lg navbar-inner " data-bs-theme="light">
    <div class="container py-2 ">
        <a class="text-gradient special-font navbar-brand text-success" href="{{ route('/') }}">MTs At-Taufiq</a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-0 gap-md-3">
                 <x-nav-link :active="request()->routeIs('/')" href="{{ route('/') }}">
                    <i class="fa-solid fa-house me-1"></i>
                    Home
                </x-nav-link>
                <x-nav-link :active="request()->routeIs('profil-madrasah')" href="{{ route('profil-madrasah') }}">
                    <i class="fa-solid fa-school me-1"></i>
                    Profil Madrasah
                </x-nav-link>
                <x-nav-link :active="request()->routeIs('kesiswaan')" href="{{ route('kesiswaan') }}">
                    <i class="fa-solid fa-people-group me-1"></i>
                    Kesiswaan
                </x-nav-link>

                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Sejarah Madrasah</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li> --}}
            </ul>
            {{-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> --}}
        </div>
    </div>
</nav>