<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BrandForge</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container">

           <a class="navbar-brand fw-bold" href="{{ route('website.home') }}">
                <i class="bi bi-shop"></i> BrandForge
            </a>

            <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                  <ul class="navbar-nav ms-auto">

                  <li class="nav-item">
                        <a class="nav-link" href="{{ route('website.home') }}">
                            Home
                        </a>
                    </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pelanggan.dashboardBelanja') }}">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                   <a class="nav-link" href="{{ route('website.produk') }}">
                            Produk
                        </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('website.tentang') }}">
                        Tentang
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('website.kontak') }}">
                        Kontak
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link position-relative"
                        href="{{ route('pelanggan.keranjang') }}">

                        🛒 Keranjang

                        @auth
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ \App\Models\Keranjang::where('user_id', auth()->id())->count() }}
                            </span>
                        @endauth

                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pelanggan.index') }}">
                        Status Pesanan
                    </a>
                </li>

                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-danger btn-sm ms-2">
                            Logout
                        </button>
                    </form>
                </li>

            </ul>
            </div>

        </div>
    </nav>

    {{-- Content --}}
    <div class="container mt-4">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>