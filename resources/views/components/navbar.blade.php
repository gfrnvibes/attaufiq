<nav class="navbar navbar-expand-lg navbar-inner" data-bs-theme="light">
    <div class="container py-2">
        <a class="text-gradient special-font navbar-brand text-success" href="{{ route('/') }}">MTs At-Taufiq</a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active fw-bold text-success" aria-current="page" href="/">
                        <i class="fa-solid fa-house me-1"></i>
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profil-madrasah') }}">Profil Madrasah</a>
                </li>
                <li class="nav-item dropdown">
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
                </li>
            </ul>
            {{-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> --}}
        </div>
    </div>
</nav>