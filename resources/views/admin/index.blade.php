    @extends('layouts.app')

    @section('title', 'Dashboard Admin')

    @section('content')

    <div class="container mt-4">

        <h2 class="mb-3">Dashboard Admin</h2>

        <p>Role Login: {{ auth()->user()->role }}</p>
        
        @if(auth()->user()->role == 'owner')
            <a href="/owner" class="btn btn-primary">
                Dashboard Owner
            </a>
    @endif

        <p>
            Selamat Datang,
            <b>{{ auth()->user()->name }}</b>
        </p>

        <div class="row">

            <!-- KATEGORI -->
            <div class="col-md-4 mb-4">
                <div class="card card-menu bg-primary text-white">
                    <div class="card-body text-center">

                        <h1>📂</h1>

                        <h4>Kategori</h4>

                        <p>Kelola data kategori produk.</p>

                        <a href="{{ route('kategori.index') }}" class="btn btn-light">
                            Kelola
                        </a>

                    </div>
                </div>
            </div>

            <!-- PRODUK -->
            <div class="col-md-4 mb-4">
                <div class="card card-menu bg-success text-white">
                    <div class="card-body text-center">

                        <h1>📦</h1>

                        <h4>Produk</h4>

                        <p>Kelola data produk.</p>

                        <a href="{{ route('produk.index') }}" class="btn btn-light">
                            Kelola
                        </a>

                    </div>
                </div>
            </div>

            <!-- UKURAN -->
            <div class="col-md-4 mb-4">
                <div class="card card-menu bg-warning">
                    <div class="card-body text-center">

                        <h1>📏</h1>

                        <h4>Ukuran</h4>

                        <p>Kelola data ukuran.</p>

                        <a href="{{ route('ukuran.index') }}" class="btn btn-dark">
                            Kelola
                        </a>

                    </div>
                </div>
            </div>

            <!-- WARNA -->
            <div class="col-md-4 mb-4">
                <div class="card card-menu bg-danger text-white">
                    <div class="card-body text-center">

                        <h1>🎨</h1>

                        <h4>Warna</h4>

                        <p>Kelola data warna.</p>

                        <a href="{{ route('warna.index') }}" class="btn btn-light">
                            Kelola
                        </a>

                    </div>
                </div>
            </div>

            <!-- STOK -->
            <div class="col-md-4 mb-4">
                <div class="card card-menu bg-dark text-white">
                    <div class="card-body text-center">

                        <h1>📦</h1>

                        <h4>Stok</h4>

                        <p>Kelola stok produk.</p>

                        <a href="{{ route('stok.index') }}" class="btn btn-light">
                            Kelola
                        </a>

                    </div>
                </div>
            </div>

        </div>
    </div>

    @endsection