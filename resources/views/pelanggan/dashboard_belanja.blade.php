@extends('pelanggan.layouts.app')

@section('title', 'Dashboard Belanja')

@section('content')

<div class="container py-4">

    <h2 class="mb-4">
        Dashboard Belanja
    </h2>

    <div class="alert alert-primary">
        Halo, Pelanggan 👋
    </div>

    <div class="row">

        <!-- Belanja Produk -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">

                    <i class="bi bi-bag fs-1 text-primary"></i>

                    <h4 class="mt-3">
                        Belanja Produk
                    </h4>

                    <p>
                        Pilih produk yang ingin dibeli.
                    </p>

                    <a href="{{ route('website.produk') }}"
                       class="btn btn-primary w-100">
                        🛍️ Belanja Produk
                    </a>

                </div>
            </div>
        </div>

        <!-- Keranjang -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">

                    <i class="bi bi-cart fs-1 text-success"></i>

                    <h4 class="mt-3">
                        Keranjang
                    </h4>

                    <p>
                        Produk yang akan dibeli.
                    </p>

                    <a href="{{ route('pelanggan.keranjang') }}"
                        class="btn btn-success position-relative w-100">

                            🛒 Keranjang

                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $jumlahKeranjang }}
                            </span>

                        </a>

                </div>
            </div>
        </div>

        <!-- Dashboard Status -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">

                    <i class="bi bi-speedometer2 fs-1 text-warning"></i>

                    <h4 class="mt-3">
                        Dashboard Status
                    </h4>

                    <p>
                        Melihat status pesanan.
                    </p>

                    <a href="{{ route('pelanggan.index') }}"
                       class="btn btn-warning w-100">
                        📊 Dashboard Status
                    </a>

                </div>
            </div>
        </div>

    </div>

</div>

@endsection