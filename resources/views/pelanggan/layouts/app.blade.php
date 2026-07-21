<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | BrandForge</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body{
            background:#f8f9fa;
        }

        .navbar-brand{
            font-weight:bold;
        }

        .hero{
            background:linear-gradient(135deg,#0d6efd,#0a58ca);
            color:white;
            padding:90px 0;
        }

        footer{
            background:#212529;
            color:white;
            padding:25px 0;
            margin-top:60px;
        }

        .card{
            border:none;
            transition:.3s;
        }

        .card:hover{
            transform:translateY(-5px);
            box-shadow:0 10px 25px rgba(0,0,0,.15);
        }

        .nav-link{
            font-weight:500;
        }
    </style>

</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">

            <a class="navbar-brand" href="{{ route('website.home') }}">
                BrandForge
            </a>

            <button class="navbar-toggler" type="button"
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
                        <a class="nav-link" href="{{ route('website.tentang') }}">
                            Tentang
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('website.produk') }}">
                            Produk
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('website.kontak') }}">
                            Kontak
                        </a>
                    </li>

                    @guest

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                Login
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="btn btn-primary ms-2"
                               href="{{ route('register') }}">
                                Daftar
                            </a>
                        </li>

                   @else

                    {{-- Jika login sebagai Owner --}}
                    @if(auth()->user()->role == 'owner')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('owner.index') }}">
                                <i class="bi bi-speedometer2"></i> Dashboard Owner
                            </a>
                        </li>
                    @endif

                    {{-- Jika login sebagai Pelanggan --}}
                    @if(auth()->user()->role == 'pelanggan')

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pelanggan.dashboardBelanja') }}">
                                Dashboard
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('website.produk') }}">
                                Belanja
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
                            <a class="nav-link" href="{{ route('pelanggan.keranjang') }}">
                                Keranjang
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pelanggan.index') }}">
                                Status Pesanan
                            </a>
                        </li>

                    @endif

                    <li class="nav-item ms-2">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-danger">
                                Logout
                            </button>
                        </form>
                    </li>

                @endguest
                </ul>

            </div>

        </div>
    </nav>

    <!-- Isi Halaman -->
    <main>

        @yield('content')

    </main>

    <!-- Footer -->
    <footer>

        <div class="container text-center">

            <h5>BrandForge</h5>

            <p>
                Fashion Streetwear Indonesia
            </p>

            <hr>

            <p class="mb-0">
                © {{ date('Y') }} BrandForge. All Rights Reserved.
            </p>

        </div>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>