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

    {{-- MENU DASHBOARD --}}
    <div class="row">

        <!-- Belanja Produk -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">

                    <i class="bi bi-bag fs-1 text-primary"></i>

                    <h4 class="mt-3">Belanja Produk</h4>

                    <p>Pilih produk yang ingin dibeli.</p>

                    <a href="{{ route('pelanggan.belanja') }}"
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

                    <h4 class="mt-3">Keranjang</h4>

                    <p>Produk yang akan dibeli.</p>

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

                    <h4 class="mt-3">Dashboard Status</h4>

                    <p>Melihat status pesanan.</p>

                    <a href="{{ route('pelanggan.index') }}"
                       class="btn btn-warning w-100">
                        📊 Dashboard Status
                    </a>

                </div>
            </div>
        </div>

    </div>

    {{-- PRODUK TERBARU --}}
    <hr>

    <h4 class="mt-4 mb-3">
        🆕 Produk Terbaru
    </h4>

    <div class="row">

        @foreach($produkTerbaru as $produk)

        <div class="col-md-3 mb-4">

            <div class="card h-100 shadow-sm">

                <img src="{{ asset('storage/'.$produk->foto) }}"
                     class="card-img-top"
                     style="height:220px;object-fit:cover;">

                <div class="card-body">

                    <h6>{{ $produk->nama_produk }}</h6>

                    <p class="text-danger fw-bold">
                        Rp {{ number_format($produk->harga,0,',','.') }}
                    </p>

                    <a href="{{ route('pelanggan.detailProduk',$produk->id) }}"
                       class="btn btn-primary btn-sm w-100">
                        Lihat Detail
                    </a>

                </div>

            </div>

        </div>

        @endforeach

    </div>

    {{-- PRODUK TERLARIS --}}
    <hr>

    <h4 class="mt-4 mb-3">
        🔥 Produk Terlaris
    </h4>

    <div class="row">

        @foreach($produkTerlaris as $produk)

        <div class="col-md-3 mb-4">

            <div class="card h-100 shadow-sm">

                <img src="{{ asset('storage/'.$produk->foto) }}"
                     class="card-img-top"
                     style="height:220px;object-fit:cover;">

                <div class="card-body">

                    <h6>{{ $produk->nama_produk }}</h6>

                    <p class="text-danger fw-bold">
                        Rp {{ number_format($produk->harga,0,',','.') }}
                    </p>

                    <small class="text-success">
                        Terjual {{ $produk->detail_transaksi_sum_jumlah ?? 0 }} pcs
                    </small>

                    <a href="{{ route('pelanggan.detailProduk',$produk->id) }}"
                       class="btn btn-primary btn-sm w-100 mt-2">
                        Lihat Detail
                    </a>

                </div>

            </div>

        </div>

        @endforeach

    </div>
    {{-- PRODUK REKOMENDASI --}}
<hr>

<h4 class="mt-4 mb-3">
    ⭐ Produk Rekomendasi
</h4>

<div class="row">

@forelse($produkRekomendasi as $produk)

<div class="col-md-3 mb-4">

    <div class="card h-100 shadow-sm">

        @if($produk->foto)
            <img src="{{ asset('storage/'.$produk->foto) }}"
                 class="card-img-top"
                 style="height:220px;object-fit:cover;">
        @else
            <img src="https://via.placeholder.com/400x220?text=Produk"
                 class="card-img-top"
                 style="height:220px;object-fit:cover;">
        @endif

        <div class="card-body">

            <h6>{{ $produk->nama_produk }}</h6>

            <p class="text-danger fw-bold">
                Rp {{ number_format($produk->harga,0,',','.') }}
            </p>

            <small class="text-success d-block mb-2">
                Terjual {{ $produk->detail_transaksi_sum_jumlah ?? 0 }} pcs
            </small>

            <a href="{{ route('pelanggan.detailProduk',$produk->id) }}"
               class="btn btn-success btn-sm w-100">
                Lihat Detail
            </a>

        </div>

    </div>

</div>

@empty

<div class="col-12">
    <div class="alert alert-warning">
        Belum ada produk rekomendasi.
    </div>
</div>

@endforelse

</div>

</div>

@endsection